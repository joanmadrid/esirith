<?php

namespace Game\GameBundle\Twig;

use Game\CharacterBundle\Entity\Character;
use Game\GameBundle\Entity\Boss;
use Game\GameBundle\Manager\BossManager;
use Game\GameBundle\Manager\GameManager;
use Game\GameBundle\Manager\RaidManager;
use Game\UserBundle\Entity\User;

class BossExtension extends \Twig_Extension
{
    private $environment;

    /** @var BossManager */
    private $bossManager;

    /** @var GameManager */
    private $gameManager;

    /** @var RaidManager */
    private $raidManager;

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
     * @param RaidManager $raidManager
     */
    public function setRaidManager($raidManager)
    {
        $this->raidManager = $raidManager;
    }


    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('renderHealthStatus', array($this, 'renderHealthStatus')),
            new \Twig_SimpleFunction('renderGameDays', array($this, 'renderGameDays')),
            new \Twig_SimpleFunction('getActiveRaids', array($this, 'getActiveRaids')),
            new \Twig_SimpleFunction('getCharacterRaidAgainstBoss', array($this, 'getCharacterRaidAgainstBoss')),
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
     * @param Character $char
     * @return string
     */
    public function renderGameDays(Character $char)
    {
        $game = $char->getGame();
        return $this->gameManager->getGameDays($game);
    }

    /**
     * @param Boss $boss
     * @return array
     */
    public function getActiveRaids(Boss $boss)
    {
        $raids = $this->raidManager->getActiveRaids($boss);
        $count = 0;
        $chars = array();

        foreach ($raids as $raid) {
            $chars[] = $raid->getCharacter()->getName();
            $count++;
        }

        return array($count, $chars);
    }

    /**
     * @param Character $char
     * @param Boss $boss
     * @return bool
     */
    public function getCharacterRaidAgainstBoss(Character $char, Boss $boss)
    {
        return $this->raidManager->getCharacterRaidAgainstBoss($char, $boss);
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