<?php

namespace Game\CharacterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Game\CharacterBundle\Model\CharacterRestore;
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
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return CharacterClass
     */
    public function getClass()
    {
        return $this->class;
    }

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
}
