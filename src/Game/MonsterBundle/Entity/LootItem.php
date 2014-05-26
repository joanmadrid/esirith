<?php

namespace Game\MonsterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Game\ItemBundle\Entity\Item;

/**
 * LootItem
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\MonsterBundle\Entity\Repository\LootItemRepository")
 */
class LootItem
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
     * @var integer
     *
     * @ORM\Column(name="chance", type="integer")
     */
    private $chance;

    /**
     * @ORM\ManyToOne(targetEntity="LootTable", inversedBy="lootItems")
     * @ORM\JoinColumn(name="loottable_id", referencedColumnName="id")
     */
    private $lootTable;

    /**
     * @ORM\ManyToOne(targetEntity="Game\ItemBundle\Entity\Item", inversedBy="lootItems")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $item;


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
     * Set chance
     *
     * @param integer $chance
     * @return LootItem
     */
    public function setChance($chance)
    {
        $this->chance = $chance;
    
        return $this;
    }

    /**
     * Get chance
     *
     * @return integer 
     */
    public function getChance()
    {
        return $this->chance;
    }

    /**
     * @param Item $item
     * @return $this
     */
    public function setItem($item)
    {
        $this->item = $item;
        return $this;
    }

    /**
     * @return Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param LootTable $lootTable
     * @return $this
     */
    public function setLootTable($lootTable)
    {
        $this->lootTable = $lootTable;
        return $this;
    }

    /**
     * @return LootTable
     */
    public function getLootTable()
    {
        return $this->lootTable;
    }


}