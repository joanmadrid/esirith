<?php

namespace Game\ItemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Weapon
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\ItemBundle\Entity\Repository\WeaponRepository")
 */
class Weapon extends Item
{
    const WEAPON_TYPE_MELEE = 0;
    const WEAPON_TYPE_RANGED = 1;

    const WEAPON_HANDS_FREE = 0;
    const WEAPON_HANDS_ONE = 1;
    const WEAPON_HANDS_TWO = 2;

    const WEAPON_DAMAGE_TYPE_BLUDGEONING = 0;
    const WEAPON_DAMAGE_TYPE_PIERCING = 1;
    const WEAPON_DAMAGE_TYPE_SLASHING = 2;

    /**
     * @var integer
     *
     * @ORM\Column(name="damage_dice", type="integer")
     */
    private $damageDice;

    /**
     * @var integer
     *
     * @ORM\Column(name="damage_number", type="integer")
     */
    private $damageDiceNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="damage_type", type="integer")
     */
    private $damageType;

    /**
     * @var integer
     *
     * @ORM\Column(name="critical_chance", type="integer")
     */
    private $criticalChance;

    /**
     * @var integer
     *
     * @ORM\Column(name="critical_multiplier", type="integer")
     */
    private $criticalMultiplier;

    /**
     * @var integer
     *
     * @ORM\Column(name="weapon_type", type="integer")
     */
    private $weaponType;

    /**
     * @var integer
     *
     * @ORM\Column(name="hands", type="integer")
     */
    private $hands;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $characterItems;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $shopItems;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->characterItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setIsEquipable(true);
        $this->setIsUsable(false);
    }

    /**
     * Set damageDice
     *
     * @param integer $damageDice
     * @return Weapon
     */
    public function setDamageDice($damageDice)
    {
        $this->damageDice = $damageDice;
    
        return $this;
    }

    /**
     * Get damageDice
     *
     * @return integer 
     */
    public function getDamageDice()
    {
        return $this->damageDice;
    }

    /**
     * Set damageDiceNumber
     *
     * @param integer $damageDiceNumber
     * @return Weapon
     */
    public function setDamageDiceNumber($damageDiceNumber)
    {
        $this->damageDiceNumber = $damageDiceNumber;
    
        return $this;
    }

    /**
     * Get damageDiceNumber
     *
     * @return integer 
     */
    public function getDamageDiceNumber()
    {
        return $this->damageDiceNumber;
    }

    /**
     * Set damageType
     *
     * @param integer $damageType
     * @return Weapon
     */
    public function setDamageType($damageType)
    {
        $this->damageType = $damageType;
    
        return $this;
    }

    /**
     * Get damageType
     *
     * @return integer 
     */
    public function getDamageType()
    {
        return $this->damageType;
    }

    /**
     * Set criticalChance
     *
     * @param integer $criticalChance
     * @return Weapon
     */
    public function setCriticalChance($criticalChance)
    {
        $this->criticalChance = $criticalChance;
    
        return $this;
    }

    /**
     * Get criticalChance
     *
     * @return integer 
     */
    public function getCriticalChance()
    {
        return $this->criticalChance;
    }

    /**
     * Set criticalMultiplier
     *
     * @param integer $criticalMultiplier
     * @return Weapon
     */
    public function setCriticalMultiplier($criticalMultiplier)
    {
        $this->criticalMultiplier = $criticalMultiplier;
    
        return $this;
    }

    /**
     * Get criticalMultiplier
     *
     * @return integer 
     */
    public function getCriticalMultiplier()
    {
        return $this->criticalMultiplier;
    }

    /**
     * Set hands
     *
     * @param integer $hands
     * @return Weapon
     */
    public function setHands($hands)
    {
        $this->hands = $hands;
    
        return $this;
    }

    /**
     * Get hands
     *
     * @return integer 
     */
    public function getHands()
    {
        return $this->hands;
    }

    /**
     * Add characterItems
     *
     * @param \Game\CharacterBundle\Entity\CharacterItem $characterItems
     * @return Weapon
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
     * Set weaponType
     *
     * @param integer $weaponType
     * @return Weapon
     */
    public function setWeaponType($weaponType)
    {
        $this->weaponType = $weaponType;
    
        return $this;
    }

    /**
     * Get weaponType
     *
     * @return integer 
     */
    public function getWeaponType()
    {
        return $this->weaponType;
    }

    /**
     * Add shopItems
     *
     * @param \Game\ShopBundle\Entity\ShopItem $shopItems
     * @return Weapon
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
}