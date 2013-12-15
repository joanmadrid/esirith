<?php

namespace Game\MapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Map
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\MapBundle\Entity\MapRepository")
 */
class Map
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
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @ORM\OneToMany(targetEntity="Poi", mappedBy="map")
     */
    private $pois;


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
     * @return Map
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
     * Set filename
     *
     * @param string $filename
     * @return Map
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    
        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pois = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add pois
     *
     * @param \Game\MapBundle\Entity\Poi $pois
     * @return Map
     */
    public function addPoi(\Game\MapBundle\Entity\Poi $pois)
    {
        $this->pois[] = $pois;
    
        return $this;
    }

    /**
     * Remove pois
     *
     * @param \Game\MapBundle\Entity\Poi $pois
     */
    public function removePoi(\Game\MapBundle\Entity\Poi $pois)
    {
        $this->pois->removeElement($pois);
    }

    /**
     * Get pois
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPois()
    {
        return $this->pois;
    }
}