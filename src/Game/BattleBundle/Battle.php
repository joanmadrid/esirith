<?php

namespace Game\BattleBundle\Entity;

use Game\MapBundle\Entity\Poi;

class Battle
{

    const ENEMY_WINNER     = 0;

    const CHARACTER_WINNER = 1;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var  int $id
     */
    protected $id;

    /**
     *
     *
     * @var  $characterBattle
     */
    protected $characterBattle;

    /**
     *
     *
     * @var  $enemyBattleList
     */
    protected $enemyBattleList;

    /**
     * @ORM\
     *
     * @var  Poi $poi
     */
    protected $poi;

    /**
     * @ORM\Column(name="success", type="boolean")
     *
     * @var  boolean $success
     */
    protected $success;

    /**
     * @ORM\Column(name="winner", type="smallint")
     *
     * @var  int $winner
     */
    protected $winner;

    /**
     * @param mixed $characterBattle
     *
     * @return $this
     */
    public function setCharacterBattle($characterBattle)
    {
        $this->characterBattle = $characterBattle;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCharacterBattle()
    {
        return $this->characterBattle;
    }

    /**
     * @param mixed $enemyBattleList
     *
     * @return $this
     */
    public function setEnemyBattleList($enemyBattleList)
    {
        $this->enemyBattleList = $enemyBattleList;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnemyBattleList()
    {
        return $this->enemyBattleList;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Game\MapBundle\Entity\Poi $poi
     *
     * @return $this
     */
    public function setPoi($poi)
    {
        $this->poi = $poi;

        return $this;
    }

    /**
     * @return \Game\MapBundle\Entity\Poi
     */
    public function getPoi()
    {
        return $this->poi;
    }

    /**
     * @param boolean $success
     *
     * @return $this
     */
    public function setSuccess($success)
    {
        $this->success = $success;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param int $winner
     *
     * @return $this
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * @return int
     */
    public function getWinner()
    {
        return $this->winner;
    }
}
