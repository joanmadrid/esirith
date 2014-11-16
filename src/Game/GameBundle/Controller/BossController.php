<?php

namespace Game\GameBundle\Controller;

use Game\GameBundle\Manager\BossManager;
use Game\UserBundle\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class BossController extends Controller
{
    /**
     * @Route("/", name="game.boss.index")
     * @Template()
     */
    public function indexAction()
    {
        //$user = $this->getUserManager()->getCurrentUser();
        $character = $this->getUserManager()->getCharacter();
        $game = $character->getGame();
        $nextAttack = $this->getBossManager()->getNextAttackTimeLeft();
        return array(
            'game' => $game,
            'nextAttack' => $nextAttack
        );
    }

    /**
     * @Route("/infection/fight", name="game.boss.fightinfection")
     * @Template()
     */
    public function fightInfectionAction()
    {
        $character = $this->getUserManager()->getCharacter();
        $poi = $character->getCurrentPoi();
        $success = $this->getBossManager()->fightInfection($character, $poi);

        if ($success) {
            $this->get('session')->getFlashBag()->add(
                'success',
                'You have destroyed the enemy infestation clearing the path. You won '
                .BossManager::INFECTION_FIGHT_WIN_XP.' XP'
            );
        } else {
            $this->get('session')->getFlashBag()->add(
                'error',
                'You couldn\'t fight the infestation back, losing '.BossManager::INFECTION_FIGHT_LOSE_HP.' HP'
            );
        }
        $this->getBossManager()->flush();

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
     * @return BossManager
     */
    private function getBossManager()
    {
        return $this->get('game.boss_manager');
    }
}
