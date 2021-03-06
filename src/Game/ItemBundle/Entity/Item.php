<?php

namespace Game\ItemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;

/**
 * Item
 *
 * @ORM\Entity(repositoryClass="Game\ItemBundle\Entity\Repository\ItemRepository")
 * @ORM\Table()
 * @ORM\InheritanceType("JOINED")
 * @DiscriminatorColumn(name="type", type="smallint")
 * @DiscriminatorMap({
 *      "1" = "Game\ItemBundle\Entity\Weapon",
 *      "2" = "Game\ItemBundle\Entity\Armor",
 *      "3" = "Game\ItemBundle\Entity\Potion"})
 */
abstract class Item
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
     * @ORM\Column(name="value", type="integer")
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="Game\CharacterBundle\Entity\CharacterItem", mappedBy="item")
     */
    protected $characterItems;

    /**
     * @ORM\OneToMany(targetEntity="Game\ShopBundle\Entity\ShopItem", mappedBy="item")
     */
    protected $shopItems;

    /**
     * @ORM\OneToMany(targetEntity="Game\MonsterBundle\Entity\LootItem", mappedBy="item")
     */
    protected $lootItems;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_equipable", type="boolean")
     */
    private $isEquipable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_usable", type="boolean")
     */
    private $isUsable;

    public function __construct()
    {
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
     * @return Item
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
     * Add characterItems
     *
     * @param \Game\CharacterBundle\Entity\CharacterItem $characterItems
     * @return Item
     */
    public function addCharacterItem(\Game\CharacterBundle\Entity\CharacterItem $characterItems)
    {
        $this->characterItems[] = $characterItems;
    
        return $this;
    }

    /**
     * Remove characterItems
     *
     * @param \Game\CharacterBundle\Entity\CharacterItem $characterItems
     */
    public function removeCharacterItem(\Game\CharacterBundle\Entity\CharacterItem $characterItems)
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
     * Set value
     *
     * @param integer $value
     * @return Item
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Add shopItems
     *
     * @param \Game\ShopBundle\Entity\ShopItem $shopItems
     * @return Item
     */
    public function addShopItem(\Game\ShopBundle\Entity\ShopItem $shopItems)
    {
        $this->shopItems[] = $shopItems;
    
        return $this;
    }

    /**
     * Remove shopItems
     *
     * @param \Game\ShopBundle\Entity\ShopItem $shopItems
     */
    public function removeShopItem(\Game\ShopBundle\Entity\ShopItem $shopItems)
    {
        $this->shopItems->removeElement($shopItems);
    }

    /**
     * Get shopItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getShopItems()
    {
        return $this->shopItems;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $lootItems
     * @return $this
     */
    public function setLootItems($lootItems)
    {
        $this->lootItems = $lootItems;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLootItems()
    {
        return $this->lootItems;
    }

    /**
     * @param boolean $isEquipable
     * @return $this
     */
    public function setIsEquipable($isEquipable)
    {
        $this->isEquipable = $isEquipable;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsEquipable()
    {
        return $this->isEquipable;
    }

    /**
     * @param boolean $isUsable
     * @return $this
     */
    public function setIsUsable($isUsable)
    {
        $this->isUsable = $isUsable;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsUsable()
    {
        return $this->isUsable;
    }
}