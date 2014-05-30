<?php

namespace Game\ItemBundle\Manager;

use Game\CharacterBundle\Entity\CharacterItem;

interface EquipableWeaponInterface
{
    public function canEquip(CharacterItem $charItem);
} 