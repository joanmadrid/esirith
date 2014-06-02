<?php

namespace Game\BattleBundle\Model;

//use Game\BattleBundle\Entity\Battle;
//use Game\CharacterBundle\Entity\Character;

use Game\MonsterBundle\Entity\Monster;

class BattleResult
{

    protected $status;

    protected $currentHP;

    protected $monstersKilled = array();

    protected $gainedXP = 0;//gamedo: seguramente un manager tiene que hacer el calculo, a partir de los monstruos muertos

    /**
     * @var BattleLog
     */
    protected $log;

    public function generateJSON()
    {
        $monstersKilled = array();

        foreach($this->monstersKilled as $monsterKilled) {
            $monstersKilled[] = $monsterKilled->getPlayer()->getName();
        }

        return json_encode(array(
            'status' => $this->status,
            'currentHP' => $this->currentHP,
            'gainedXP' => $this->gainedXP,
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
     * @param mixed $gainedXP
     */
    public function setGainedXP($gainedXP)
    {
        $this->gainedXP = $gainedXP;
    }

    /**
     * @return mixed
     */
    public function getGainedXP()
    {
        return $this->gainedXP;
    }

    /**
     * @param $amount
     */
    public function addGainedXP($amount)
    {
        $this->setGainedXP($this->getGainedXP() + $amount);
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