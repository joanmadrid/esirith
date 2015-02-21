<?php

namespace Game\GameBundle\Controller;

use Game\GameBundle\Manager\RaidManager;
use Game\UserBundle\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class RaidController extends Controller
{
    /**
     * @Route("/join", name="game.raid.join")
     * @Template()
     */
    public function joinRaidAction()
    {
        $character = $this->getUserManager()->getCharacter();
        $poi = $character->getCurrentPoi();
        $boss = $poi->getBoss();

        if ($this->getRaidManager()->joinRaid($character, $poi, $boss)) {
            $this->getRaidManager()->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                'You have joined the raid against '.$boss->getName()
            );
        } else {
            //gamedo: aqui se llega si ya esta en la raid, o si no cuadran los parametros, aunque solo devuelve 1 tipo de error
            $this->get('session')->getFlashBag()->add(
                'success',
                'You are already on this raid'
            );
        }
        return $this->redirect($this->generateUrl('map.view'));
    }

    /**
     * @return UserManager
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }

    /**
     * @return RaidManager
     */
    private function getRaidManager()
    {
        return $this->get('game.raid_manager');
    }
}
