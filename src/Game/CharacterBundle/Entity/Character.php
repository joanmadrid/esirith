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
    protected $gold;

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
     */
    public function setGold($gold)
    {
        $this->gold = $gold;
    }

    /**
     * @return int
     */
    public function getGold()
    {
        return $this->gold;
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
