<?php

namespace Game\ItemBundle\Manager;

use Game\CharacterBundle\Entity\Character;
use Game\CharacterBundle\Entity\CharacterItem;
use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\ItemBundle\Entity\Potion;
use Game\ItemBundle\Entity\Repository\ArmorRepository;

class PotionManager extends CoreManager
{
    const POTION_HEALTH_RESTORE = 100;

    /** @var RollManager */
    protected $rollManager;

    /**
     * @param CharacterItem $charItem
     */
    public function drink(CharacterItem $charItem)
    {
        /** @var Potion $potion */
        $potion = $charItem->getItem();
        $char = $charItem->getCharacter();

        switch ($potion->getPotionType()) {
            case Potion::POTION_TYPE_HEAL:
                $char->restore(100);
                $this->persist($char);
                break;
        }
        $this->remove($charItem);
    }

    /**
     * @return ArmorRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @param $rollManager
     */
    public function setRollManager($rollManager)
    {
        $this->rollManager = $rollManager;
    }
}