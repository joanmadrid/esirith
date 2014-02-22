<?php

namespace Game\MapBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Game\BattleBundle\Manager\BattleManager;
use Game\CharacterBundle\CharacterEventList;
use Game\CharacterBundle\Event\CharacterEvent;
use Game\CharacterBundle\Manager\CharacterManager;
use Game\CoreBundle\Manager\RollManager;
use Game\MapBundle\Manager\MapManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Game\MapBundle\Entity\Poi;
use Game\CharacterBundle\Entity\Character;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Game\UserBundle\Manager\UserManager;
use Game\ItemBundle\Manager\SpawnManager;

class TravelController extends Controller
{
    /**
     * @Route("/to/{id}", name="map.travel.to")
     * @Template()
     * @ParamConverter("poi", class="MapBundle:Poi")
     */
    public function toAction(Poi $poi)
    {
        $char = $this->getUserManager()->getCharacter();

        /** @var CharacterEvent $characterEvent */
        $characterEvent = new CharacterEvent($char);
        $characterEvent = $this->getEventDispatcher()->dispatch(CharacterEventList::TRAVEL, $characterEvent);

        try {
            $path = $this->getMapManager()->findPathToPoi($char->getCurrentPoi(), $poi);
            $this->getCharacterManager()->move($char, $poi);
        } catch (NotFoundHttpException $exc) {
            $characterMap = $char->getCurrentPoi()->getMap();

            return $this->redirect($this->generateUrl('map.view', array('id' => $characterMap->getId())));
        }

        $diceRoll      = $this->getRollManager()->roll(1, 100);
        $triggerBattle = $this->getMapManager()->triggerBattle($path, $diceRoll);

        if ($triggerBattle) {
            $monsters = $this->getSpawnManager()->spawnMonsters($path->getEnd());
            $battle = $this->getBattleManager()->createMonsterBattle($char, $monsters, $path->getEnd());
        }

        $this->getCharacterManager()->flush();

        return array(
            'char'    => $char,
            'poi'     => $poi,
            'dice'    => $diceRoll->getRollResult(),
            'combat'  => $triggerBattle,
            'restore' => $characterEvent->getCharacterRestore()
        );
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
            $characterMap = $char->getCurrentPoi()->getMap();
            return $this->redirect($this->generateUrl('map.view', array('id' => $characterMap->getId())));
        }

        $this->getCharacterManager()->flush();

        return array(
            'char'    => $char,
            'poi'     => $poi,
            'link'    => $link
        );
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
}
