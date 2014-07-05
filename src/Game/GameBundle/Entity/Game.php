<?php

namespace Game\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\GameBundle\Entity\Repository\GameRepository")
 */
class Game
{
    const STATUS_IN_PROGRESS = 0;
    const STATUS_ENDED = 1;

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
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime", nullable=true)
     */
    private $end;

    /**
     * @ORM\OneToOne(targetEntity="Boss", mappedBy="game")
     */
    private $boss;

    /**
     * @ORM\OneToMany(targetEntity="Game\CharacterBundle\Entity\Character", mappedBy="game")
     */
    private $characters;

    /**
     * @ORM\Column(name="status", type="integer")
     */
    private $status = 0;

    /**
     * @ORM\OneToMany(targetEntity="Game\MapBundle\Entity\Map", mappedBy="game")
     */
    private $maps;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->characters = new \Doctrine\Common\Collections\ArrayCollection();
        $this->maps = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @return Game
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
     * @param \DateTime $start
     * @return Game
     */
    public function setStart($start)
    {
        $this->start = $start;
    
        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Game
     */
    public function setEnd($end)
    {
        $this->end = $end;
    
        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Game
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
     * Set boss
     *
     * @param \Game\GameBundle\Entity\Boss $boss
     * @return Game
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

    /**
     * Add characters
     *
     * @param \Game\CharacterBundle\Entity\Character $characters
     * @return Game
     */
    public function addCharacter(\Game\CharacterBundle\Entity\Character $characters)
    {
        $this->characters[] = $characters;
    
        return $this;
    }

    /**
     * Remove characters
     *
     * @param \Game\CharacterBundle\Entity\Character $characters
     */
    public function removeCharacter(\Game\CharacterBundle\Entity\Character $characters)
    {
        $this->characters->removeElement($characters);
    }

    /**
     * Get characters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCharacters()
    {
        return $this->characters;
    }

    /**
     * Add maps
     *
     * @param \Game\MapBundle\Entity\Map $maps
     * @return Game
     */
    public function addMap(\Game\MapBundle\Entity\Map $maps)
    {
        $this->maps[] = $maps;
    
        return $this;
    }

    /**
     * Remove maps
     *
     * @param \Game\MapBundle\Entity\Map $maps
     */
    public function removeMap(\Game\MapBundle\Entity\Map $maps)
    {
        $this->maps->removeElement($maps);
    }

    /**
     * Get maps
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMaps()
    {
        return $this->maps;
    }
}