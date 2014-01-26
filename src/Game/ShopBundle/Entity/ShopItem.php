<?php

namespace Game\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Game\ItemBundle\Entity\Item;

/**
 * ShopItem
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\ShopBundle\Entity\Repository\ShopItemRepository")
 */
class ShopItem
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
     * @ORM\ManyToOne(targetEntity="Shop", inversedBy="items")
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id")
     */
    protected $shop;

    /**
     * @ORM\ManyToOne(targetEntity="Game\ItemBundle\Entity\Item", inversedBy="shopItems")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    protected $item;


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
     * Set shop
     *
     * @param \Game\ShopBundle\Entity\Shop $shop
     * @return ShopItem
     */
    public function setShop(\Game\ShopBundle\Entity\Shop $shop = null)
    {
        $this->shop = $shop;
    
        return $this;
    }

    /**
     * Get shop
     *
     * @return \Game\ShopBundle\Entity\Shop 
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * Set item
     *
     * @param \Game\ItemBundle\Entity\Item $item
     * @return ShopItem
     */
    public function setItem(\Game\ItemBundle\Entity\Item $item = null)
    {
        $this->item = $item;
    
        return $this;
    }

    /**
     * Get item
     *
     * @return \Game\ItemBundle\Entity\Item 
     */
    public function getItem()
    {
        return $this->item;
    }
}