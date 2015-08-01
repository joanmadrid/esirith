<?php

namespace Game\GameBundle\Manager;

use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\GameBundle\Entity\Game;
use Game\GameBundle\Entity\Repository\GameRepository;
use Proxies\__CG__\Game\CharacterBundle\Entity\Character;

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

    /**
     * omitdo: si esta lleno, crear otro, etc..
     * @return Game
     */
    public function findOpenGameToJoin()
    {
        $games = $this->getRepository()->getInProgressWithBoss();
        return $games[0];
    }

    /**
     * @return array
     */
    public function getAvailableGamesWithPlayers()
    {
        return $this->getRepository()->getAvailableGamesWithPlayers();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOneById($id)
    {
        return $this->getRepository()->findOneById($id);
    }

    /**
     * @param $charId
     * @return array
     */
    public function getFromCharacter($charId)
    {
        return $this->getRepository()->getFromCharacter($charId);
    }

    /**
     * @param Game $game
     */
    public function endGame(Game $game, $reason)
    {
        $game->setStatus(Game::STATUS_ENDED_LOST);
        $game->setReason($reason);
        $this->persist($game);

//        foreach ($game->getCharacters() as $char) {
//            /** @var $char Character */
//            $char->setDead(true);
//        }
    }
}
