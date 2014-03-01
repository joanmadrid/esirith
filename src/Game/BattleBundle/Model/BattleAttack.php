<?php

namespace Game\BattleBundle\Model;

class BattleAttack {
    protected $damage = 0;

    protected $criticals = 0;

    protected $hits = 0;

    protected $miss = 0;

    /**
     * @param mixed $criticals
     */
    public function setCriticals($criticals)
    {
        $this->criticals = $criticals;
    }

    /**
     * @return mixed
     */
    public function getCriticals()
    {
        return $this->criticals;
    }

    /**
     * @param mixed $damage
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;
    }

    /**
     * @return mixed
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @param mixed $hits
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
    }

    /**
     * @return mixed
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * @param mixed $miss
     */
    public function setMiss($miss)
    {
        $this->miss = $miss;
    }

    /**
     * @return mixed
     */
    public function getMiss()
    {
        return $this->miss;
    }


}