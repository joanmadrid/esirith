<?php

namespace Game\CharacterBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Game\CharacterBundle\Model\CharacterRestore;
use Game\GameBundle\Entity\Game;
use Game\MapBundle\Entity\Poi;
use Game\UserBundle\Entity\User;
use Game\CharacterBundle\Entity\CharacterItem;

/**
 * Character
 *
 * @ORM\Table(name="`Character`")
 * @ORM\Entity(repositoryClass="Game\CharacterBundle\Entity\Repository\CharacterRepository")
 */
class Character extends Attributes
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
     * @ORM\OneToMany(targetEntity="CharacterItem", mappedBy="character")
     */
    protected $characterItems;

    /**
     * @var integer
     *
     * @ORM\Column(name="gold", type="integer", length=255)
     */
    protected $gold = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Game\UserBundle\Entity\User", inversedBy="characters")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Game\BattleBundle\Entity\Battle", mappedBy="character")
     */
    protected $battles;

    /**
     * @var integer
     *
     * @ORM\Column(name="xp", type="integer", length=255)
     */
    protected $xp = 0;

    /**
     * @ORM\ManyToOne(targetEntity="CharacterClass")
     * @ORM\JoinColumn(name="class_id", referencedColumnName="id")
     */
    protected $class;

    /**
     * @ORM\OneToMany(targetEntity="Game\MapBundle\Entity\Treasure", mappedBy="openedBy")
     */
    protected $openedTreasures;

    /**
     * @var bool
     *
     * @ORM\Column(name="dead", type="boolean")
     */
    protected $dead = false;

    /**
     * @var string
     *
     * @ORM\Column(name="portrait", type="string", length=255, nullable=true)
     */
    private $portrait;

    /**
     * @ORM\Column(name="last_connection", type="datetime", nullable=true)
     */
    private $lastConnection;

    /**
     * @ORM\OneToMany(targetEntity="Game\CompanionBundle\Entity\Companion", mappedBy="character")
     */
    private $companions;

    /**
     * @ORM\Column(name="last_companion_generation", type="datetime", nullable=true)
     */
    private $lastCompanionGeneration;

    /**
     * @ORM\ManyToOne(targetEntity="Game\GameBundle\Entity\Game", inversedBy="characters")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    protected $game;

    /**
     * @ORM\OneToMany(targetEntity="Game\GameBundle\Entity\Raid", mappedBy="character")
     */
    private $raids;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->characterItems = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
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
     * @param Poi $currentPoi
     *
     * @return Character
     */
    public function setCurrentPoi(Poi $currentPoi = null)
    {
        $this->currentPoi = $currentPoi;

        return $this;
    }

    /**
     * Get currentPoi
     *
     * @return Poi
     */
    public function getCurrentPoi()
    {
        return $this->currentPoi;
    }

    /**
     * Add characterItems
     *
     * @param CharacterItem $characterItems
     *
     * @return Character
     */
    public function addCharacterItem(CharacterItem $characterItems)
    {
        $this->characterItems[] = $characterItems;

        return $this;
    }

    /**
     * Remove characterItems
     *
     * @param CharacterItem $characterItems
     */
    public function removeCharacterItem(CharacterItem $characterItems)
    {
        $this->characterItems->removeElement($characterItems);
    }

    /**
     * Get characterItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCharacterItems()
    {
        return $this->characterItems;
    }

    /**
     * @param int $gold
     * @return $this
     */
    public function setGold($gold)
    {
        $this->gold = $gold;
        return $this;
    }

    /**
     * @return int
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * @param mixed $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param int $xp
     * @return $this
     */
    public function setXp($xp)
    {
        $this->xp = $xp;
        return $this;
    }

    /**
     * @return int
     */
    public function getXp()
    {
        return $this->xp;
    }

    /**
     * @param CharacterClass $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return CharacterClass
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $openedTreasures
     */
    public function setOpenedTreasures($openedTreasures)
    {
        $this->openedTreasures = $openedTreasures;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOpenedTreasures()
    {
        return $this->openedTreasures;
    }

    /**
     * @param boolean $dead
     * @return $this
     */
    public function setDead($dead)
    {
        $this->dead = $dead;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getDead()
    {
        return $this->dead;
    }

    /**
     * @param string $portrait
     * @return $this
     */
    public function setPortrait($portrait)
    {
        $this->portrait = $portrait;
        return $this;
    }

    /**
     * @return string
     */
    public function getPortrait()
    {
        return $this->portrait;
    }

    /**
     * @param mixed $lastConnection
     * @return $this
     */
    public function setLastConnection($lastConnection)
    {
        $this->lastConnection = $lastConnection;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastConnection()
    {
        return $this->lastConnection;
    }

    /**
     * @param mixed $companions
     */
    public function setCompanions($companions)
    {
        $this->companions = $companions;
    }

    /**
     * @return mixed
     */
    public function getCompanions()
    {
        return $this->companions;
    }

    /**
     * @param \DateTime $lastCompanionGeneration
     * @return $this
     */
    public function setLastCompanionGeneration($lastCompanionGeneration)
    {
        $this->lastCompanionGeneration = $lastCompanionGeneration;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastCompanionGeneration()
    {
        return $this->lastCompanionGeneration;
    }

    /**
     * @param Game $game
     * @return $this
     */
    public function setGame($game)
    {
        $this->game = $game;
        return $this;
    }

    /**
     * @return Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @return mixed
     */
    public function getRaids()
    {
        return $this->raids;
    }

    //// CUSTOM ////

    /**
     * @param $points
     */
    public function restore($points)
    {
        $maxHP = $this->getHp();
        $currentHP = $this->getCurrentHp() + $points;

        if ($currentHP > $maxHP) {
            $currentHP = $maxHP;
        }

        $this->setCurrentHp($currentHP);
    }

    /**
     * @param $amount
     * @return int
     */
    public function decreaseHP($amount)
    {
        $this->setCurrentHp($this->getCurrentHp()-$amount);
        return $this->getCurrentHp();
    }

    /**
     * @param $amount
     * @return $this
     */
    public function addXP($amount)
    {
        $this->setXp($this->getXp() + $amount);
        return $this;
    }

    /**
     * @param $amount
     * @return $this
     */
    public function addGold($amount)
    {
        $this->setGold($this->getGold() + $amount);
        return $this;
    }

    /**
     * @param $amount
     * @return bool
     */
    public function removeGold($amount)
    {
        if ($this->getGold() >= $amount) {
            $this->setGold($this->getGold()-$amount);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function checkIsDead()
    {
        if ($this->getCurrentHp() <= 0) {
            $this->setDead(true);
            return true;
        } else {
            return false;
        }
    }
}
