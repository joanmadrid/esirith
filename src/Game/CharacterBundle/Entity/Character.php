<?php

namespace Game\CharacterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Game\MapBundle\Entity\Poi;

/**
 * Character
 *
 * @ORM\Table(name="`Character`")
 * @ORM\Entity()
 */
class Character
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Game\MapBundle\Entity\Poi", inversedBy="characters")
     * @ORM\JoinColumn(name="poi_id", referencedColumnName="id")
     */
    protected $currentPoi;

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
     * Set name
     *
     * @param string $name
     * @return Character
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set currentPoi
     *
     * @param \Game\MapBundle\Entity\Poi $currentPoi
     * @return Character
     */
    public function setCurrentPoi(\Game\MapBundle\Entity\Poi $currentPoi = null)
    {
        $this->currentPoi = $currentPoi;
    
        return $this;
    }

    /**
     * Get currentPoi
     *
     * @return \Game\MapBundle\Entity\Poi 
     */
    public function getCurrentPoi()
    {
        return $this->currentPoi;
    }
}