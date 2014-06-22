<?php

namespace Game\GameBundle\Manager;

use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\GameBundle\Entity\Game;
use Game\GameBundle\Entity\Repository\GameRepository;

class GameManager extends CoreManager
{

    /** @var RollManager */
    protected $rollManager;

    /**
     * @return GameRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @param RollManager $rollManager
     */
    public function setRollManager($rollManager)
    {
        $this->rollManager = $rollManager;
    }

    /**
     * @param Game $game
     * @return string
     */
    public function getGameDays(Game $game)
    {
        $start = $game->getStart();
        $now = new \DateTime();

        return $diff = intval($now->diff($start)->format("%a"))+1;
    }

    /**
     * @param Game $game
     * @return bool
     */
    public function checkIfGameEnded(Game $game)
    {
        //gamedo: si han matado al boss han ganado

        //gamedo: si no quedan pois sin infectar, han perdido
        return false;
    }

    /**
     * @return array
     */
    public function getInProgressWithBoss()
    {
        return $this->getRepository()->getInProgressWithBoss();
    }
}
