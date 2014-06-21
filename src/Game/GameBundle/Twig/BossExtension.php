<?php

namespace Game\GameBundle\Twig;

use Game\GameBundle\Manager\BossManager;
use Game\GameBundle\Manager\GameManager;
use Game\UserBundle\Entity\User;

class BossExtension extends \Twig_Extension
{
    private $environment;

    /** @var BossManager */
    private $bossManager;

    /** @var GameManager */
    private $gameManager;

    /**
     * @param BossManager $bossManager
     */
    public function setBossManager($bossManager)
    {
        $this->bossManager = $bossManager;
    }

    /**
     * @param GameManager $gameManager
     */
    public function setGameManager($gameManager)
    {
        $this->gameManager = $gameManager;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('renderHealthStatus', array($this, 'renderHealthStatus')),
            new \Twig_SimpleFunction('renderGameDays', array($this, 'renderGameDays')),
        );
    }

    /**
     * @param $currentHP
     * @param $maxHP
     * @return mixed
     */
    public function renderHealthStatus($currentHP, $maxHP)
    {
        $hpStatus = $this->bossManager->getHPStatus($currentHP, $maxHP);
        return $this->environment->render('GameBundle:Render:healthStatus.html.twig', array('hpStatus' => $hpStatus));
    }

    /**
     * @param User $user
     * @return string
     */
    public function renderGameDays(User $user)
    {
        $game = $user->getGame();
        return $this->gameManager->getGameDays($game);
    }

    /**
     * @param \Twig_Environment $environment
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'boss_extension';
    }
}