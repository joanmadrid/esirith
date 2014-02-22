<?php

namespace Game\ItemBundle\Manager;

use Game\ItemBundle\Entity\Repository\WeaponRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\ItemBundle\Entity\Item;
use Game\ItemBundle\Entity\Weapon;
use Game\CoreBundle\Manager\RollManager;
use Game\CharacterBundle\Entity\Character;
use Game\CharacterBundle\Entity\CharacterItem;

class WeaponManager extends CoreManager
{
    const EQUIP_ERROR_HANDS = -1;

    /** @var RollManager */
    protected $rollManager;

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

    /**
     * Devuelve true si es el item es un Weapon
     *
     * @param Item $item
     * @return bool
     */
    public function isWeapon(Item $item)
    {
        return true;
    }


    /**
     * Devuelve el resultado de una tirada de daño
     *
     * @param Weapon $weapon
     * @return \Game\CoreBundle\Model\Roll
     */
    public function rollDamage(Weapon $weapon)
    {
        return $this->rollManager->roll($weapon->getDamageDiceNumber(), $weapon->getDamageDice());
    }

    /**
     * @param Character $char
     * @return mixed
     */
    public function getEquippedWeapons(Character $char)
    {
        return $this->getRepository()->getEquippedWeapons($char);
    }

    /**
     * Devuelve si puede equipar un arma o no
     * - mira que no supere 2 manos
     *
     * @param CharacterItem $charItem
     * @return bool
     */
    public function canEquip(CharacterItem $charItem)
    {
        $char = $charItem->getCharacter();
        $item = $charItem->getItem();
        $weapons = $this->getEquippedWeapons($char);
        $handCount = 0;

        foreach ($weapons as $weapon) {
            $handCount += $weapon->getHands();
        }

        if(($handCount + $item->getHands()) > 2) {
            return EQUIP_ERROR_HANDS;
        }

        return true;
    }
}