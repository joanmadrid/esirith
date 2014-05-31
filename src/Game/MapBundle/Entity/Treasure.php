<?php

namespace Game\MapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Game\MapBundle\Entity\Poi;

/**
 * Treasure
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\MapBundle\Entity\Repository\TreasureRepository")
 */
class Treasure
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
     * @ORM\Column(name="gold", type="integer")
     */
    private $gold;

    /**
     * @var boolean
     *
     * @ORM\Column(name="opened", type="boolean")
     */
    private $opened = false;

    /**
     * @ORM\OneToOne(targetEntity="Poi", inversedBy="restPoint")
     * @ORM\JoinColumn(name="poi_id", referencedColumnName="id")
     */
    protected $poi;


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
     * Set gold
     *
     * @param integer $gold
     * @return Treasure
     */
    public function setGold($gold)
    {
        $this->gold = $gold;
    
        return $this;
    }

    /**
     * Get gold
     *
     * @return integer 
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * Set opened
     *
     * @param boolean $opened
     * @return Treasure
     */
    public function setOpened($opened)
    {
        $this->opened = $opened;
    
        return $this;
    }

    /**
     * Get opened
     *
     * @return boolean 
     */
    public function getOpened()
    {
        return $this->opened;
    }

    /**
     * Set poi
     *
     * @param \Game\MapBundle\Entity\Poi $poi
     * @return Treasure
     */
    public function setPoi(\Game\MapBundle\Entity\Poi $poi = null)
    {
        $this->poi = $poi;
    
        return $this;
    }

    /**
     * Get poi
     *
     * @return \Game\MapBundle\Entity\Poi 
     */
    public function getPoi()
    {
        return $this->poi;
    }
}