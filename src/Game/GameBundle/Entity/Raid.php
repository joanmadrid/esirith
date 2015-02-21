<?php

namespace Game\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Raid
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\GameBundle\Entity\Repository\RaidRepository")
 */
class Raid
{
    const STATUS_WAITING = 0;
    const STATUS_WON = 1; //players lost
    const STATUS_LOST = 2; //players won

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="Game\CharacterBundle\Entity\Character", inversedBy="raids")
     * @ORM\JoinColumn(name="char_id", referencedColumnName="id")
     */
    private $character;

    /**
     * @ORM\ManyToOne(targetEntity="Boss", inversedBy="raids")
     * @ORM\JoinColumn(name="boss_id", referencedColumnName="id")
     */
    private $boss;


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
     * Set created
     *
     * @param \DateTime $created
     * @return Raid
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Raid
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set character
     *
     * @param \Game\CharacterBundle\Entity\Character $character
     * @return Raid
     */
    public function setCharacter(\Game\CharacterBundle\Entity\Character $character = null)
    {
        $this->character = $character;
    
        return $this;
    }

    /**
     * Get character
     *
     * @return \Game\CharacterBundle\Entity\Character 
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * Set boss
     *
     * @param \Game\GameBundle\Entity\Boss $boss
     * @return Raid
     */
    public function setBoss(\Game\GameBundle\Entity\Boss $boss = null)
    {
        $this->boss = $boss;
    
        return $this;
    }

    /**
     * Get boss
     *
     * @return \Game\GameBundle\Entity\Boss 
     */
    public function getBoss()
    {
        return $this->boss;
    }
}