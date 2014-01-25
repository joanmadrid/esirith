<?php

namespace Game\NpcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Game\MapBundle\Entity\Poi;

/**
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="user_unique",columns={"npc_id", "poi_id"})})
 * @ORM\Entity()
 * @UniqueEntity(fields={"npc", "poi"})
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
     * @ORM\ManyToOne(targetEntity="Game\NpcBundle\Entity\Npc", inversedBy="spawnList")
     * @ORM\JoinColumn(name="npc_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @var  Npc $npc
     */
    protected $npc;

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
     * @param \Game\NpcBundle\Entity\Npc $npc
     *
     * @return $this
     */
    public function setNpc($npc)
    {
        $this->npc = $npc;

        return $this;
    }

    /**
     * @return \Game\NpcBundle\Entity\Npc
     */
    public function getNpc()
    {
        return $this->npc;
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
}
