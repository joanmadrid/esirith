<?php

namespace Game\ItemBundle\Manager;

use Game\ItemBundle\Entity\Repository\WeaponRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\ItemBundle\Entity\Item;
use Game\ItemBundle\Entity\Weapon;
use Game\CoreBundle\Manager\RollManager;

class WeaponManager extends CoreManager
{
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
}