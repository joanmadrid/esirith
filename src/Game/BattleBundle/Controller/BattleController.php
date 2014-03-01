<?php

namespace Game\BattleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Game\BattleBundle\Manager\BattleManager;
use Game\UserBundle\Manager\UserManager;
use Game\BattleBundle\Entity\Battle;
use Game\CharacterBundle\Entity\Character;

class BattleController extends Controller
{
    /**
     * @Route("/view", name="battle.battle.view")
     * @Template()
     */
    public function viewAction()
    {
        $char = $this->getUserManager()->getCharacter();
        $battle = $this->getBattleManager()->getActiveBattle($char);
        return array(
            'battle' => $battle
        );
    }

    /**
     * @Route("/resolve", name="battle.battle.resolve")
     */
    public function resolveAction()
    {
        /** @var Character $char */
        $char = $this->getUserManager()->getCharacter();

        /** @var Battle $battle */
        $battle = $this->getBattleManager()->getActiveBattle($char);

        $result = $this->getBattleManager()->resolveBattle($battle);
        $this->getBattleManager()->flush();

        $char->setCurrentHp($result->getCurrentHP());
        $em = $this->getDoctrine()->getManager();
        $em->persist($char);
        $em->flush();

        return $this->redirect(
            $this->generateUrl(
                "battle.battle.result",
                array(
                    'id' => $battle->getId()
                )
            )
        );
    }

    /**
     * @Route("/result/{id}", name="battle.battle.result", requirements={"id" = "\d+"})
     * @ParamConverter("battle", class="BattleBundle:Battle")
     * @Template()
     */
    public function resultAction(Battle $battle)
    {
        $char = $this->getUserManager()->getCharacter();
        return array(
            'battle' => $battle
        );
    }

    /**
     * @return BattleManager
     */
    private function getBattleManager()
    {
        return $this->get('battle.battle_manager');
    }

    /**
     * @return UserManager;
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }
}