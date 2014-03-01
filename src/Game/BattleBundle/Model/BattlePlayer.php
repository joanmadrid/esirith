<?php

namespace Game\BattleBundle\Model;

use Game\CharacterBundle\Entity\Attributes;

class BattlePlayer extends Attributes
{
    /** @var Attributes */
    protected $player;

    protected $initiative;

    protected $enemy;

    protected $lastTarget = -1;

    /**
     * @param mixed $initiative
     */
    public function setInitiative($initiative)
    {
        $this->initiative = $initiative;
    }

    /**
     * @return mixed
     */
    public function getInitiative()
    {
        return $this->initiative;
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    /**
     * @return Attributes
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param mixed $enemy
     */
    public function setEnemy($enemy)
    {
        $this->enemy = $enemy;
    }

    /**
     * @return mixed
     */
    public function getEnemy()
    {
        return $this->enemy;
    }

    /**
     * @param mixed $lastTarget
     */
    public function setLastTarget($lastTarget)
    {
        $this->lastTarget = $lastTarget;
    }

    /**
     * @return mixed
     */
    public function getLastTarget()
    {
        return $this->lastTarget;
    }

    /**
     * Está muerto?
     *
     * @return bool
     */
    public function isDead()
    {
        return $this->getCurrentHp() <= 0;
    }

    /**
     * Resta vida
     *
     * @param $amount
     */
    public function decreaseHP($amount)
    {
        $this->setCurrentHp($this->getCurrentHp() - $amount);
    }
}