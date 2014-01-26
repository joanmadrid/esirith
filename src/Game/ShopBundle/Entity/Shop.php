<?php

namespace Game\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Game\MapBundle\Entity\Poi;
use Game\ShopBundle\Entity\ShopItem;

/**
 * Shop
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\ShopBundle\Entity\Repository\ShopRepository")
 */
class Shop
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
     * @ORM\Column(name="sellIncrement", type="integer")
     */
    private $sellIncrement;

    /**
     * @var integer
     *
     * @ORM\Column(name="buyDecrement", type="integer")
     */
    private $buyDecrement;

    /**
     * @ORM\ManyToOne(targetEntity="Game\MapBundle\Entity\Poi", inversedBy="shops")
     * @ORM\JoinColumn(name="poi_id", referencedColumnName="id")
     */
    protected $poi;

    /**
     * @ORM\OneToMany(targetEntity="ShopItem", mappedBy="shop")
     */
    protected $items;


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
     * @return Shop
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
     * Set sellIncrement
     *
     * @param integer $sellIncrement
     * @return Shop
     */
    public function setSellIncrement($sellIncrement)
    {
        $this->sellIncrement = $sellIncrement;
    
        return $this;
    }

    /**
     * Get sellIncrement
     *
     * @return integer 
     */
    public function getSellIncrement()
    {
        return $this->sellIncrement;
    }

    /**
     * Set buyDecrement
     *
     * @param integer $buyDecrement
     * @return Shop
     */
    public function setBuyDecrement($buyDecrement)
    {
        $this->buyDecrement = $buyDecrement;
    
        return $this;
    }

    /**
     * Get buyDecrement
     *
     * @return integer 
     */
    public function getBuyDecrement()
    {
        return $this->buyDecrement;
    }

    /**
     * Set poi
     *
     * @param \Game\MapBundle\Entity\Poi $poi
     * @return Shop
     */
    public function setPoi(\Game\MapBundle\Entity\Poi $poi = null)
    {
        $this->poi = $poi;
    
        return $this;
    }

    /**
     * Get poi
     *
     * @return \Game\MapBundle\Entity\Poi 
     */
    public function getPoi()
    {
        return $this->poi;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add items
     *
     * @param \Game\ShopBundle\Entity\ShopItem $items
     * @return Shop
     */
    public function addItem(\Game\ShopBundle\Entity\ShopItem $items)
    {
        $this->items[] = $items;
    
        return $this;
    }

    /**
     * Remove items
     *
     * @param \Game\ShopBundle\Entity\ShopItem $items
     */
    public function removeItem(\Game\ShopBundle\Entity\ShopItem $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }
}