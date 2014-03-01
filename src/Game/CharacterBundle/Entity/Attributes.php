<?php

namespace Game\CharacterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class Attributes
{
    /**
     * @var int
     *
     * @ORM\Column(name="hp", type="integer")
     */
    protected $hp;

    /**
     * @var int
     *
     * @ORM\Column(name="current_hp", type="integer")
     */
    protected $currentHp;

    /**
     * @var integer
     *
     * @ORM\Column(name="damage", type="integer")
     */
    protected $damage;

    /**
     * @var integer
     *
     * @ORM\Column(name="defense", type="integer")
     */
    protected $defense;

    /**
     * @var integer
     *
     * @ORM\Column(name="str", type="integer")
     */
    protected $str;

    /**
     * @var integer
     *
     * @ORM\Column(name="dex", type="integer")
     */
    protected $dex;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     */
    protected $level;

    /**
     * @param int $currentHp
     *
     * @return $this
     */
    public function setCurrentHp($currentHp)
    {
        $this->currentHp = $currentHp;

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentHp()
    {
        return $this->currentHp;
    }

    /**
     * @param int $damage
     *
     * @return $this
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;

        return $this;
    }

    /**
     * @return int
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @param int $defense
     *
     * @return $this
     */
    public function setDefense($defense)
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * @return int
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * @param int $dex
     *
     * @return $this
     */
    public function setDex($dex)
    {
        $this->dex = $dex;

        return $this;
    }

    /**
     * @return int
     */
    public function getDex()
    {
        return $this->dex;
    }

    /**
     * @param int $str
     *
     * @return $this
     */
    public function setStr($str)
    {
        $this->str = $str;

        return $this;
    }

    /**
     * @return int
     */
    public function getStr()
    {
        return $this->fue;
    }

    /**
     * @param int $hp
     *
     * @return $this
     */
    public function setHp($hp)
    {
        $this->hp = $hp;

        return $this;
    }

    /**
     * @return int
     */
    public function getHp()
    {
        return $this->hp;
    }

    /**
     * @param int $level
     *
     * @return $this
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }
}
