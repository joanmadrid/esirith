<?php

namespace Game\MapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poi
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\MapBundle\Entity\Repository\PoiRepository")
 */
class Poi
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
     * @var integer
     *
     * @ORM\Column(name="x", type="integer")
     */
    private $x;

    /**
     * @var integer
     *
     * @ORM\Column(name="y", type="integer")
     */
    private $y;

    /**
     * @ORM\ManyToOne(targetEntity="Map", inversedBy="pois")
     * @ORM\JoinColumn(name="map_id", referencedColumnName="id")
     */
    protected $map;

    /**
     * @ORM\OneToMany(targetEntity="Path", mappedBy="start")
     */
    protected $startPaths;


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
     * @return Poi
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
     * Set x
     *
     * @param integer $x
     * @return Poi
     */
    public function setX($x)
    {
        $this->x = $x;
    
        return $this;
    }

    /**
     * Get x
     *
     * @return integer 
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param integer $y
     * @return Poi
     */
    public function setY($y)
    {
        $this->y = $y;
    
        return $this;
    }

    /**
     * Get y
     *
     * @return integer 
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set map
     *
     * @param \Game\MapBundle\Entity\Map $map
     * @return Poi
     */
    public function setMap(\Game\MapBundle\Entity\Map $map = null)
    {
        $this->map = $map;
    
        return $this;
    }

    /**
     * Get map
     *
     * @return \Game\MapBundle\Entity\Map 
     */
    public function getMap()
    {
        return $this->map;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->startPaths = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add startPaths
     *
     * @param \Game\MapBundle\Entity\Path $startPaths
     * @return Poi
     */
    public function addStartPath(\Game\MapBundle\Entity\Path $startPaths)
    {
        $this->startPaths[] = $startPaths;
    
        return $this;
    }

    /**
     * Remove startPaths
     *
     * @param \Game\MapBundle\Entity\Path $startPaths
     */
    public function removeStartPath(\Game\MapBundle\Entity\Path $startPaths)
    {
        $this->startPaths->removeElement($startPaths);
    }

    /**
     * Get startPaths
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStartPaths()
    {
        return $this->startPaths;
    }
}