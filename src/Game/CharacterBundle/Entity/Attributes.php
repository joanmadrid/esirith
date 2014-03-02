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
    protected $hp = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="current_hp", type="integer")
     */
    protected $currentHp = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="damage", type="integer")
     */
    protected $damage = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="defense", type="integer")
     */
    protected $defense = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="str", type="integer")
     */
    protected $str = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="dex", type="integer")
     */
    protected $dex = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="intel", type="integer")
     */
    protected $int = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="spi", type="integer")
     */
    protected $spi = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="current_mana", type="integer")
     */
    protected $currentMana = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="mana", type="integer")
     */
    protected $mana = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     */
    protected $level = 1;

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
        return $this->str;
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

    /**
     * @param int $currentMana
     */
    public function setCurrentMana($currentMana)
    {
        $this->currentMana = $currentMana;
    }

    /**
     * @return int
     */
    public function getCurrentMana()
    {
        return $this->currentMana;
    }

    /**
     * @param int $int
     */
    public function setInt($int)
    {
        $this->int = $int;
    }

    /**
     * @return int
     */
    public function getInt()
    {
        return $this->int;
    }

    /**
     * @param int $mana
     */
    public function setMana($mana)
    {
        $this->mana = $mana;
    }

    /**
     * @return int
     */
    public function getMana()
    {
        return $this->mana;
    }

    /**
     * @param int $spi
     */
    public function setSpi($spi)
    {
        $this->spi = $spi;
    }

    /**
     * @return int
     */
    public function getSpi()
    {
        return $this->spi;
    }


}
