<?php

namespace Game\CharacterBundle\Manager;

use Game\CharacterBundle\Entity\Repository\CharacterItemRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\CharacterBundle\Entity\CharacterItem;
use Game\ItemBundle\Entity\Repository\ItemRepository;

class CharacterItemManager extends CoreManager
{
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
}
