<?php

namespace Game\MapBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Game\BattleBundle\Entity\Battle;
use Game\BattleBundle\Manager\BattleManager;
use Game\BattleBundle\Model\BattleResult;
use Game\CharacterBundle\CharacterEventList;
use Game\CharacterBundle\Event\CharacterEvent;
use Game\CharacterBundle\Manager\CharacterManager;
use Game\CharacterBundle\Manager\XPManager;
use Game\CoreBundle\Manager\RollManager;
use Game\MapBundle\Manager\MapManager;
use Game\MonsterBundle\Manager\LootManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Game\MapBundle\Entity\Poi;
use Game\CharacterBundle\Entity\Character;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Game\UserBundle\Manager\UserManager;
use Game\MonsterBundle\Manager\SpawnManager;

class TravelController extends Controller
{
    /**
     * @Route("/to/{id}", name="map.travel.to")
     * @Template()
     * @ParamConverter("poi", class="MapBundle:Poi")
     */
    public function toAction(Poi $poi)
    {
        /** @var Character $char */
        $char = $this->getUserManager()->getCharacter();

        /** @var CharacterEvent $characterEvent */
        $characterEvent = new CharacterEvent($char);
        $characterEvent = $this->getEventDispatcher()->dispatch(CharacterEventList::TRAVEL, $characterEvent);

        try {
            $path = $this->getMapManager()->findPathToPoi($char->getCurrentPoi(), $poi);
            $this->getCharacterManager()->move($char, $poi);
        } catch (NotFoundHttpException $exc) {
            return $this->redirect($this->generateUrl('map.view'));
        }

        $diceRoll      = $this->getRollManager()->roll(1, 100);
        $triggerBattle = $this->getMapManager()->triggerBattle($path, $diceRoll);

        if ($triggerBattle) {
            $monsters = $this->getSpawnManager()->spawnMonsters($path->getEnd());
            $battle = $this->getBattleManager()->createMonsterBattle($char, $monsters, $path->getEnd());
            /** @var BattleResult $result */
            list($result, $loot, $xp) = $this->resolveBattle($battle);

            //si pierde
            if ($result->getStatus() == BattleResult::STATUS_LOST) {
                if ($char->getCurrentHp() <= 0) {
                    //muere?
                    if ($this->getCharacterManager()->rollDeath()) {
                        $char->setDead(true);
                        $this->getCharacterManager()->flush();
                        $this->getUserManager()->unselectCharacter();
                        return $this->redirect($this->generateUrl('character.death', array('id'=>$char->getId())));
                    } else {
                        $char->setCurrentHp(1);
                    }
                }
            }

            $this->getCharacterManager()->flush();

            return array(
                'char'    => $char,
                'poi'     => $poi,
                'dice'    => $diceRoll->getRollResult(),
                'restored' => $characterEvent->getRestored(),
                'result' => $result,
                'loot' => $loot,
                'battle' => $battle,
                'xp' => $xp
            );
        } else {
            $this->getCharacterManager()->flush();
            return $this->redirect($this->generateUrl('map.view'));
        }
    }

    /**
     * Viaja a un linkedPoi
     *
     * @Route("/enter/{id}", name="map.travel.enter")
     * @Template()
     * @ParamConverter("poi", class="MapBundle:Poi")
     */
    public function enterAction(Poi $poi)
    {
        $char = $this->getUserManager()->getCharacter();

        try {
            $link = $this->getMapManager()->findLinkToPoi($char->getCurrentPoi(), $poi);
            $this->getCharacterManager()->move($char, $poi);
        } catch (NotFoundHttpException $exc) {
            return $this->redirect($this->generateUrl('map.view'));
        }

        $this->getCharacterManager()->flush();

        return array(
            'char'    => $char,
            'poi'     => $poi,
            'link'    => $link
        );
    }

    /**
     * @param Battle $battle
     * @return array
     */
    private function resolveBattle(Battle $battle)
    {
        //battle
        $result = $this->getBattleManager()->resolveBattle($battle);
        $char = $battle->getCharacter();

        //xp
        $xp = $this->getXPManager()->calculateXPFromBattleResult($result, $char);
        $char->addXP($xp);

        $loot = null;
        if ($result->getStatus() == BattleResult::STATUS_WON) {
            //loot
            $loot = $this->getLootManager()->generateBattleLoot($result);
            $this->getLootManager()->giveTo($char, $loot);
            $this->getLootManager()->flush();
            $battle->setLoot($loot->generateJSON());
        }

        //hp
        $char->setCurrentHp($result->getCurrentHP());

        $em = $this->getDoctrine()->getManager();
        $em->persist($char);
        $em->flush();

        $this->getBattleManager()->flush();

        return array($result, $loot, $xp);
    }

    /**
     * @return EventDispatcher
     */
    protected function getEventDispatcher()
    {
        return $this->get('event_dispatcher');
    }

    /**
     * @return CharacterManager
     */
    protected function getCharacterManager()
    {
        return $this->get('character.character_manager');
    }

    /**
     * @return MapManager
     */
    protected function getMapManager()
    {
        return $this->get('map.map_manager');
    }

    /**
     * @return BattleManager
     */
    protected function getBattleManager()
    {
        return $this->get('battle.battle_manager');
    }

    /**
     * @return RollManager
     */
    protected function getRollManager()
    {
        return $this->get('core.roll_manager');
    }

    /**
     * @return UserManager;
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }

    /**
     * @return SpawnManager
     */
    private function getSpawnManager()
    {
        return $this->get('monster.spawn_manager');
    }

    /**
     * @return LootManager;
     */
    private function getLootManager()
    {
        return $this->get('monster.loot_manager');
    }

    /**
     * @return XPManager
     */
    private function getXPManager()
    {
        return $this->get('character.xp_manager');
    }
}
