<?php

namespace Game\MapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Game\MapBundle\Entity\Poi;

/**
 * Path
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\MapBundle\Entity\PathRepository")
 */
class Path
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
     * @var float
     *
     * @ORM\Column(name="danger", type="decimal")
     */
    private $danger;

    /**
     * @ORM\ManyToOne(targetEntity="Poi", inversedBy="startPaths")
     * @ORM\JoinColumn(name="start_id", referencedColumnName="id")
     */
    private $start;

    /**
     * @ORM\ManyToOne(targetEntity="Poi", inversedBy="endPaths")
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
     * Set danger
     *
     * @param float $danger
     * @return Path
     */
    public function setDanger($danger)
    {
        $this->danger = $danger;
    
        return $this;
    }

    /**
     * Get danger
     *
     * @return float 
     */
    public function getDanger()
    {
        return $this->danger;
    }

    /**
     * Set start
     *
     * @param Poi $start
     * @return Path
     */
    public function setStart(Poi $start = null)
    {
        $this->start = $start;
    
        return $this;
    }

    /**
     * Get start
     *
     * @return Poi
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param Poi $end
     * @return Path
     */
    public function setEnd(Poi $end = null)
    {
        $this->end = $end;
    
        return $this;
    }

    /**
     * Get end
     *
     * @return Poi
     */
    public function getEnd()
    {
        return $this->end;
    }
}