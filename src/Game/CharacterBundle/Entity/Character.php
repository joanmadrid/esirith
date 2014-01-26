<?php

namespace Game\CharacterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Game\CharacterBundle\Model\CharacterRestore;
use Game\MapBundle\Entity\Poi;

use Game\CharacterBundle\Entity\CharacterItem;

/**
 * Character
 *
 * @ORM\Table(name="`Character`")
 * @ORM\Entity(repositoryClass="Game\CharacterBundle\Entity\Repository\CharacterRepository")
 */
class Character
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
     * @var int
     *
     * @ORM\Column(name="hp", type="integer")
     */
    protected $hp;

    /**
     * @var int
     *
     * @ORM\Column(name="current_hp", type="integer")
     */
    protected $currentHp;

    /**
     * @var integer
     *
     * @ORM\Column(name="damage", type="integer")
     */
    protected $damage;

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
     * @param mixed $currentHp
     *
     * @return $this
     */
    public function setCurrentHp($currentHp)
    {
        $this->currentHp = $currentHp;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrentHp()
    {
        return $this->currentHp;
    }

    /**
     * @param int $damage
     *
     * @return $this
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;

        return $this;
    }

    /**
     * @return int
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @param int $hp
     *
     * @return $this
     */
    public function setHp($hp)
    {
        $this->hp = $hp;

        return $this;
    }

    /**
     * @return int
     */
    public function getHp()
    {
        return $this->hp;
    }

    /**
     * @return CharacterRestore
     */
    public function restore()
    {
        $characterRestore = new CharacterRestore();
        $characterRestore
            ->setHp($this->restoreHp());

        return $characterRestore;
    }

    /**
     * @return int
     */
    protected function restoreHp()
    {
        $hpRestored      = mt_rand(1, 3);
        $this->currentHp = $this->currentHp + $hpRestored;
        if ($this->currentHp > $this->hp) {
            $this->currentHp = $this->hp;
        }

        return $hpRestored;
    }
}
