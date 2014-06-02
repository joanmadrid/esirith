<?php

namespace Game\BattleBundle\Model;


class BattleLog
{
    private $turns = array();

    /**
     * @param string $turn
     * @internal param array $turns
     */
    public function addTurn($turn = '')
    {
        $this->turns[] = $turn;
    }

    /**
     * @return array
     */
    public function getTurns()
    {
        return $this->turns;
    }


} 