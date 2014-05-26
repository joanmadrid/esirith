<?php

namespace Game\MonsterBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Game\ItemBundle\Entity\Item;

class Loot
{
    private $items = array();

    private $gold = 0;

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
     * @param \Doctrine\Common\Collections\ArrayCollection $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Item $item
     * @return $this
     */
    public function addItem($item)
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @param Loot $loot
     * @return $this
     */
    public function addLoot(Loot $loot)
    {
        $this->gold += $loot->getGold();
        $this->items = array_merge($this->items, $loot->items);
        return $this;
    }

    /**
     * @return string
     */
    public function generateJSON()
    {
        $info['gold'] = $this->getGold();
        $info['items'] = array();

        foreach ($this->items as $item) {
            $info['items'][] = $item->getId();
        }

        return json_encode($info);
    }
} 