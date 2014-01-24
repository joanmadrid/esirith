<?php

namespace Game\CharacterBundle\Manager;

use Game\CharacterBundle\Entity\Repository\CharacterItemRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\CharacterBundle\Entity\CharacterItem;

class CharacterItemManager extends CoreManager
{
    /**
     * @return ItemRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    public function equip(CharacterItem $item)
    {
        $item->setEquipped(true);
        $this->persist($item, true);
        return true;
    }

    public function unequip(CharacterItem $item)
    {
        $item->setEquipped(false);
        $this->persist($item, true);
        return true;
    }
}