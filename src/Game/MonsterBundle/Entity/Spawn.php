<?php

namespace Game\MonsterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Game\MapBundle\Entity\Poi;

/**
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="user_unique",columns={"monster_id", "poi_id"})})
 * @ORM\Entity(repositoryClass="Game\MonsterBundle\Entity\Repository\SpawnRepository")
 * @UniqueEntity(fields={"monster", "poi"})
 */
class Spawn
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int $id
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Game\MonsterBundle\Entity\Monster", inversedBy="spawnList")
     * @ORM\JoinColumn(name="monster_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @var  Monster $monster
     */
    protected $monster;

    /**
     * @ORM\ManyToOne(targetEntity="Game\MapBundle\Entity\Poi", inversedBy="spawnList")
     * @ORM\JoinColumn(name="poi_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @var  Poi $poi
     */
    protected $poi;

    /**
     * @ORM\Column(name="rate", type="integer")
     *
     * @var  int $rate
     */
    protected $rate;

    /**
     * @ORM\Column(name="min", type="integer")
     *
     * @var  int $rate
     */
    protected $min;

    /**
     * @ORM\Column(name="max", type="integer")
     *
     * @var  int $rate
     */
    protected $max;

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Game\MonsterBundle\Entity\Monster $monster
     *
     * @return $this
     */
    public function setMonster($monster)
    {
        $this->monster = $monster;

        return $this;
    }

    /**
     * @return \Game\MonsterBundle\Entity\Monster
     */
    public function getMonster()
    {
        return $this->monster;
    }

    /**
     * @param \Game\MapBundle\Entity\Poi $poi
     *
     * @return $this
     */
    public function setPoi($poi)
    {
        $this->poi = $poi;

        return $this;
    }

    /**
     * @return \Game\MapBundle\Entity\Poi
     */
    public function getPoi()
    {
        return $this->poi;
    }

    /**
     * @param int $rate
     *
     * @return $this
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @return int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param int $max
     * @return $this
     */
    public function setMax($max)
    {
        $this->max = $max;
        return $this;
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param int $min
     * @return $this
     */
    public function setMin($min)
    {
        $this->min = $min;
        return $this;
    }

    /**
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }


}