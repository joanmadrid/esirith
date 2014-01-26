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
     * @ORM\Column(name="fue", type="integer")
     */
    protected $fue;

    /**
     * @var integer
     *
     * @ORM\Column(name="des", type="integer")
     */
    protected $des;

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
     * @param int $des
     *
     * @return $this
     */
    public function setDes($des)
    {
        $this->des = $des;

        return $this;
    }

    /**
     * @return int
     */
    public function getDes()
    {
        return $this->des;
    }

    /**
     * @param int $fue
     *
     * @return $this
     */
    public function setFue($fue)
    {
        $this->fue = $fue;

        return $this;
    }

    /**
     * @return int
     */
    public function getFue()
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
