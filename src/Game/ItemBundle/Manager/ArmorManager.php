<?php

namespace Game\ItemBundle\Manager;

use Game\CharacterBundle\Entity\Character;
use Game\CharacterBundle\Entity\CharacterItem;
use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\ItemBundle\Entity\Repository\ArmorRepository;

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
        $armor = $this->getEquippedArmor($char);

        return $armor === null;
    }

    /**
     * @param Character $char
     * @return mixed
     */
    public function getEquippedArmor(Character $char)
    {
        return $this->getRepository()->getEquippedArmor($char);
    }

    /**
     * @return ArmorRepository
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