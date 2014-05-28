<?php

namespace Game\ItemBundle\Manager;

use Game\CharacterBundle\Entity\Character;
use Game\CharacterBundle\Entity\CharacterItem;
use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;

class ArmorManager extends CoreManager implements EquipableWeaponInterface
{
    /** @var RollManager */
    protected $rollManager;

    /**
     * @param CharacterItem $charItem
     * @return bool
     */
    public function canEquip(CharacterItem $charItem)
    {
        $char = $charItem->getCharacter();
        $armors = $this->getEquippedArmors($char);

        return count($armors)==0;
    }

    /**
     * @param Character $char
     * @return mixed
     */
    public function getEquippedArmors(Character $char)
    {
        return $this->getRepository()->getEquippedArmors($char);
    }

    /**
     * @return ItemRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    public function setRollManager($rollManager)
    {
        $this->rollManager = $rollManager;
    }
}