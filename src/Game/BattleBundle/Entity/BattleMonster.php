<?php

namespace Game\BattleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Game\BattleBundle\Entity\Battle;
use Game\MonsterBundle\Entity\Monster;

/**
 * BattleMonster
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\BattleBundle\Entity\BattleMonsterRepository")
 */
class BattleMonster
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="Game\MonsterBundle\Entity\Monster", inversedBy="battleMonsters")
     * @ORM\JoinColumn(name="monster_id", referencedColumnName="id")
     */
    private $monster;

    /**
     * @ORM\ManyToOne(targetEntity="Battle", inversedBy="battleMonsters")
     * @ORM\JoinColumn(name="battle_id", referencedColumnName="id")
     */
    private $battle;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return BattleMonsters
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set monster
     *
     * @param \Game\MonsterBundle\Entity\Monster $monster
     * @return BattleMonster
     */
    public function setMonster(\Game\MonsterBundle\Entity\Monster $monster = null)
    {
        $this->monster = $monster;
    
        return $this;
    }

    /**
     * Get monster
     *
     * @return \Game\MonsterBundle\Entity\Monster 
     */
    public function getMonster()
    {
        return $this->monster;
    }

    /**
     * Set battle
     *
     * @param \Game\BattleBundle\Entity\Battle $battle
     * @return BattleMonster
     */
    public function setBattle(\Game\BattleBundle\Entity\Battle $battle = null)
    {
        $this->battle = $battle;
    
        return $this;
    }

    /**
     * Get battle
     *
     * @return \Game\BattleBundle\Entity\Battle 
     */
    public function getBattle()
    {
        return $this->battle;
    }
}