<?php

namespace Game\CharacterBundle\Manager;

use Game\CharacterBundle\Entity\Repository\CharacterItemRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\CharacterBundle\Entity\CharacterItem;
use Game\ItemBundle\Entity\Repository\ItemRepository;
use Game\ItemBundle\Manager\ArmorManager;
use Game\ItemBundle\Manager\WeaponManager;

class CharacterItemManager extends CoreManager
{
    /** @var WeaponManager */
    protected $weaponManager;

    /** @var ArmorManager */
    protected $armorManager;

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
}
