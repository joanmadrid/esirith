<?php

namespace Game\BattleBundle\Model;

//use Game\BattleBundle\Entity\Battle;
//use Game\CharacterBundle\Entity\Character;

class BattleResult {

    protected $status;

    protected $currentHP;

    public function generateJSON()
    {
        return "";
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
}