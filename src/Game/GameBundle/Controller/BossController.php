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
        $user = $this->getUserManager()->getCurrentUser();
        $game = $user->getGame();
        $nextAttack = $this->getBossManager()->getNextAttackTimeLeft();
        return array(
            'game' => $game,
            'nextAttack' => $nextAttack
        );
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
