<?php

namespace Game\CharacterBundle\Manager;

use Game\CharacterBundle\Entity\Repository\CharacterItemRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\CharacterBundle\Entity\CharacterItem;
use Game\ItemBundle\Entity\Repository\ItemRepository;
use Game\ItemBundle\Manager\ArmorManager;
use Game\ItemBundle\Manager\PotionManager;
use Game\ItemBundle\Manager\WeaponManager;

class CharacterItemManager extends CoreManager
{
    /** @var WeaponManager */
    protected $weaponManager;

    /** @var ArmorManager */
    protected $armorManager;

    /** @var PotionManager */
    protected $potionManager;

    /**
     * @param CharacterItem $charItem
     * @return bool
     */
    public function equip(CharacterItem $charItem)
    {
        $item = $charItem->getItem();
        $class = explode("\\", get_class($item));
        $class = array_pop($class);
        $equip = false;
        switch ($class) {
            case 'Weapon':
                $equip = $this->getWeaponManager()->canEquip($charItem);
                break;
            case 'Armor':
                $equip = $this->getArmorManager()->canEquip($charItem);
                break;
        }

        if ($equip === true) {
            $charItem->setEquipped(true);
            $this->persist($charItem, true);
        }
        return $equip;
    }

    /**
     * @param CharacterItem $item
     * @return bool
     */
    public function unequip(CharacterItem $item)
    {
        $item->setEquipped(false);
        $this->persist($item, true);
        return true;
    }

    /**
     * @param CharacterItem $charItem
     * @return bool
     */
    public function utilize(CharacterItem $charItem)
    {
        $item = $charItem->getItem();
        $char = $charItem->getCharacter();
        $class = explode("\\", get_class($item));
        $class = array_pop($class);
        $used = false;
        switch ($class) {
            case 'Potion':
                $this->getPotionManager()->drink($charItem);
                $used = true;
                break;
        }
        return $used;
    }

    /**
     * @param $char
     * @return array
     */
    public function getCharacterItems($char)
    {
        return $this->getRepository()->findItemsByCharacter($char);
    }

    /**
     * @return CharacterItemRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @param mixed $weaponManager
     */
    public function setWeaponManager($weaponManager)
    {
        $this->weaponManager = $weaponManager;
    }

    /**
     * @return \Game\ItemBundle\Manager\WeaponManager
     */
    public function getWeaponManager()
    {
        return $this->weaponManager;
    }

    /**
     * @param \Game\ItemBundle\Manager\ArmorManager $armorManager
     */
    public function setArmorManager($armorManager)
    {
        $this->armorManager = $armorManager;
    }

    /**
     * @return \Game\ItemBundle\Manager\ArmorManager
     */
    public function getArmorManager()
    {
        return $this->armorManager;
    }

    /**
     * @param \Game\ItemBundle\Manager\PotionManager $potionManager
     */
    public function setPotionManager($potionManager)
    {
        $this->potionManager = $potionManager;
    }

    /**
     * @return \Game\ItemBundle\Manager\PotionManager
     */
    public function getPotionManager()
    {
        return $this->potionManager;
    }
}
