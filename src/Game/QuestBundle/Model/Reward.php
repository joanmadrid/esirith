<?php

namespace Game\QuestBundle\Model;


class Reward
{
    private $gold = 0;

    private $xp = 0;

    /**
     * @param int $gold
     */
    public function setGold($gold)
    {
        $this->gold = $gold;
    }

    /**
     * @return int
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * @param int $xp
     */
    public function setXp($xp)
    {
        $this->xp = $xp;
    }

    /**
     * @return int
     */
    public function getXp()
    {
        return $this->xp;
    }
}
