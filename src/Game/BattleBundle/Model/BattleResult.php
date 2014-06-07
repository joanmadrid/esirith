<?php

namespace Game\BattleBundle\Model;

//use Game\BattleBundle\Entity\Battle;
//use Game\CharacterBundle\Entity\Character;

use Game\MonsterBundle\Entity\Monster;

class BattleResult
{
    const STATUS_WON = 1;
    const STATUS_LOST = 2;


    protected $status;

    protected $currentHP;

    protected $monstersKilled = array();

    /**
     * @var BattleLog
     */
    protected $log;

    public function generateJSON()
    {
        $monstersKilled = array();

        foreach ($this->monstersKilled as $monsterKilled) {
            $monstersKilled[] = $monsterKilled->getPlayer()->getName();
        }

        return json_encode(array(
            'status' => $this->status,
            'currentHP' => $this->currentHP,
            'monstersKilled' => $monstersKilled,
            'log' => $this->log->getTurns()
        ));
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $currentHP
     */
    public function setCurrentHP($currentHP)
    {
        $this->currentHP = $currentHP;
    }

    /**
     * @return mixed
     */
    public function getCurrentHP()
    {
        return $this->currentHP;
    }

    /**
     * @param array $monstersKilled
     */
    public function setMonstersKilled($monstersKilled)
    {
        $this->monstersKilled = $monstersKilled;
    }

    /**
     * @return array
     */
    public function getMonstersKilled()
    {
        return $this->monstersKilled;
    }

    /**
     * @param BattlePlayer $monster
     */
    public function addMonsterKilled($monster)
    {
        $this->monstersKilled[] = $monster;
    }

    /**
     * @param BattleLog $log
     */
    public function setLog($log)
    {
        $this->log = $log;
    }

    /**
     * @return array
     */
    public function getLog()
    {
        return $this->log;
    }
}