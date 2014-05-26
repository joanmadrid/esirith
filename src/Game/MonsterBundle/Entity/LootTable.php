<?php

namespace Game\MonsterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * LootTable
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\MonsterBundle\Entity\Repository\LootTableRepository")
 */
class LootTable
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
     * @var integer
     *
     * @ORM\Column(name="goldMin", type="integer")
     */
    private $goldMin = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="goldMax", type="integer")
     */
    private $goldMax = 0;

    /**
     * @ORM\OneToMany(targetEntity="Monster", mappedBy="lootTable")
     */
    private $monsters;

    /**
     * @ORM\OneToMany(targetEntity="LootItem", mappedBy="lootTable")
     */
    private $lootItems;

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
     * @return LootTable
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
     * @param int $goldMax
     * @return $this
     */
    public function setGoldMax($goldMax)
    {
        $this->goldMax = $goldMax;
        return $this;
    }

    /**
     * @return int
     */
    public function getGoldMax()
    {
        return $this->goldMax;
    }

    /**
     * @param int $goldMin
     * @return $this
     */
    public function setGoldMin($goldMin)
    {
        $this->goldMin = $goldMin;
        return $this;
    }

    /**
     * @return int
     */
    public function getGoldMin()
    {
        return $this->goldMin;
    }

    /**
     * @return mixed
     */
    public function getMonsters()
    {
        return $this->monsters;
    }

    /**
     * @return ArrayCollection
     */
    public function getLootItems()
    {
        return $this->lootItems;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->monsters = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lootItems = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add monsters
     *
     * @param \Game\MonsterBundle\Entity\Monster $monsters
     * @return LootTable
     */
    public function addMonster(\Game\MonsterBundle\Entity\Monster $monsters)
    {
        $this->monsters[] = $monsters;
    
        return $this;
    }

    /**
     * Remove monsters
     *
     * @param \Game\MonsterBundle\Entity\Monster $monsters
     */
    public function removeMonster(\Game\MonsterBundle\Entity\Monster $monsters)
    {
        $this->monsters->removeElement($monsters);
    }

    /**
     * Add lootItems
     *
     * @param \Game\MonsterBundle\Entity\LootItem $lootItems
     * @return LootTable
     */
    public function addLootItem(\Game\MonsterBundle\Entity\LootItem $lootItems)
    {
        $this->lootItems[] = $lootItems;
    
        return $this;
    }

    /**
     * Remove lootItems
     *
     * @param \Game\MonsterBundle\Entity\LootItem $lootItems
     */
    public function removeLootItem(\Game\MonsterBundle\Entity\LootItem $lootItems)
    {
        $this->lootItems->removeElement($lootItems);
    }
}