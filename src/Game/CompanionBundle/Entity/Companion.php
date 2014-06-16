<?php

namespace Game\CompanionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Game\CharacterBundle\Entity\Character;

/**
 * Companion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\CompanionBundle\Entity\Repository\CompanionRepository")
 */
class Companion
{
    const TYPE_WARRIOR = 1; // imprv chance to attack on combat
    const TYPE_WIZARD = 2; // chance to buff
    const TYPE_CLERIC = 3; // chance to heal on battle
    const TYPE_THIEF = 4; // imprv chance to loot

    const ABILITY_ADVENTURER = 1; // quicker quests
    const ABILITY_HONORABLE = 2; // save you when going to die
    const ABILITY_FIGHTER = 3; // imprv damage on combat

    const STATUS_PENDING = 0;
    const STATUS_IN_PARTY = 1;
    const STATUS_DEAD = 2;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var integer
     *
     * @ORM\Column(name="xp", type="integer")
     */
    private $xp;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="ability", type="integer")
     */
    private $ability;

    /**
     * @ORM\ManyToOne(targetEntity="Game\CharacterBundle\Entity\Character", inversedBy="companions")
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id")
     */
    private $character;

    /**
     * @ORM\Column(name="gender", type="integer")
     */
    private $gender;

    /**
     * @ORM\Column(name="portrait", type="string", length=255)
     */
    private $portrait;

    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\OneToMany(targetEntity="Game\QuestBundle\Entity\QuestInstance", mappedBy="companion")
     */
    private $questInstances;


    public function __construct()
    {
        $this->created = new \DateTime();
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
     * Set level
     *
     * @param integer $level
     * @return Companion
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set xp
     *
     * @param integer $xp
     * @return Companion
     */
    public function setXp($xp)
    {
        $this->xp = $xp;
    
        return $this;
    }

    /**
     * Get xp
     *
     * @return integer 
     */
    public function getXp()
    {
        return $this->xp;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Companion
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
     * Set status
     *
     * @param integer $status
     * @return Companion
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
     * Set type
     *
     * @param integer $type
     * @return Companion
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
     * Set ability
     *
     * @param integer $ability
     * @return Companion
     */
    public function setAbility($ability)
    {
        $this->ability = $ability;
    
        return $this;
    }

    /**
     * Get ability
     *
     * @return integer 
     */
    public function getAbility()
    {
        return $this->ability;
    }

    /**
     * Set character
     *
     * @param Character $character
     * @return Companion
     */
    public function setCharacter(Character $character = null)
    {
        $this->character = $character;
    
        return $this;
    }

    /**
     * Get character
     *
     * @return Character
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @param mixed $gender
     * @return $this
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $portrait
     * @return $this
     */
    public function setPortrait($portrait)
    {
        $this->portrait = $portrait;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPortrait()
    {
        return $this->portrait;
    }

    /**
     * @param \DateTime $created
     * @return $this
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Add questInstances
     *
     * @param \Game\QuestBundle\Entity\QuestInstance $questInstances
     * @return Companion
     */
    public function addQuestInstance(\Game\QuestBundle\Entity\QuestInstance $questInstances)
    {
        $this->questInstances[] = $questInstances;
    
        return $this;
    }

    /**
     * Remove questInstances
     *
     * @param \Game\QuestBundle\Entity\QuestInstance $questInstances
     */
    public function removeQuestInstance(\Game\QuestBundle\Entity\QuestInstance $questInstances)
    {
        $this->questInstances->removeElement($questInstances);
    }

    /**
     * Get questInstances
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestInstances()
    {
        return $this->questInstances;
    }

    //////

    /**
     * @param $amount
     * @return $this
     */
    public function addXP($amount)
    {
        $this->setXp($this->getXp() + $amount);
        return $this;
    }
}
