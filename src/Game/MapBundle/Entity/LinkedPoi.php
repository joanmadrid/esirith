<?php

namespace Game\MapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Game\MapBundle\Entity\Poi;

/**
 * LinkedPoi
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\MapBundle\Entity\Repository\LinkedPoiRepository")
 */
class LinkedPoi
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
     * @ORM\ManyToOne(targetEntity="Poi", inversedBy="startLinks")
     * @ORM\JoinColumn(name="start_id", referencedColumnName="id")
     */
    private $start;

    /**
     * @ORM\ManyToOne(targetEntity="Poi", inversedBy="endLinks")
     * @ORM\JoinColumn(name="end_id", referencedColumnName="id")
     */
    private $end;


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
     * @return LinkedPoi
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
     * Set start
     *
     * @param \Game\MapBundle\Entity\Poi $start
     * @return LinkedPoi
     */
    public function setStart(\Game\MapBundle\Entity\Poi $start = null)
    {
        $this->start = $start;
    
        return $this;
    }

    /**
     * Get start
     *
     * @return \Game\MapBundle\Entity\Poi 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \Game\MapBundle\Entity\Poi $end
     * @return LinkedPoi
     */
    public function setEnd(\Game\MapBundle\Entity\Poi $end = null)
    {
        $this->end = $end;
    
        return $this;
    }

    /**
     * Get end
     *
     * @return \Game\MapBundle\Entity\Poi 
     */
    public function getEnd()
    {
        return $this->end;
    }
}