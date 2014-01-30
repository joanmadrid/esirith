<?php

namespace Game\MapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RestPoint
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\MapBundle\Entity\Repository\RestPointRepository")
 */
class RestPoint
{
    const REST_POINT_TYPE_INN = 1;
    const REST_POINT_TYPE_SAFE_PLACE = 2;

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
     * @ORM\Column(name="cost", type="integer", nullable=true)
     */
    private $cost;

    /**
     * @var integer
     *
     * @ORM\Column(name="danger", type="integer", nullable=true)
     */
    private $danger;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

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
     * Set name
     *
     * @param string $name
     * @return RestPoint
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
     * Set cost
     *
     * @param integer $cost
     * @return RestPoint
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    
        return $this;
    }

    /**
     * Get cost
     *
     * @return integer 
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set danger
     *
     * @param integer $danger
     * @return RestPoint
     */
    public function setDanger($danger)
    {
        $this->danger = $danger;
    
        return $this;
    }

    /**
     * Get danger
     *
     * @return integer 
     */
    public function getDanger()
    {
        return $this->danger;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return RestPoint
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set poi
     *
     * @param \Game\MapBundle\Entity\Poi $poi
     * @return RestPoint
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