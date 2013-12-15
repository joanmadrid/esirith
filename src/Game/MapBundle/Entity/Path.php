<?php

namespace Game\MapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}
