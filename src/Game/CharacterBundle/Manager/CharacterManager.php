<?php

namespace Game\CharacterBundle\Manager;

use Game\CharacterBundle\Entity\Attributes;
use Game\CharacterBundle\Entity\Character;
use Game\CharacterBundle\Entity\Repository\CharacterRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\MapBundle\Entity\Poi;
use Game\ItemBundle\Manager\WeaponManager;
use Game\BattleBundle\Model\BattleAttack;
use Game\CharacterBundle\Manager\CharacterItemManager;

class CharacterManager extends CoreManager
{
    /** @var RollManager */
    protected $rollManager;

    /** @var CharacterItemManager */
    protected $characterItemManager;

    /**
     * @return CharacterRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @param \Game\CoreBundle\Manager\RollManager $rollManager
     */
    public function setRollManager($rollManager)
    {
        $this->rollManager = $rollManager;
    }

    /**
     * @param \Game\CharacterBundle\Manager\CharacterItemManager $characterItemManager
     */
    public function setCharacterItemManager($characterItemManager)
    {
        $this->characterItemManager = $characterItemManager;
    }

    /**
     * @param Character $character
     * @param Poi $poi
     */
    public function move(Character $character, Poi $poi)
    {
        $character->setCurrentPoi($poi);
        $this->persist($character);
    }

    /**
     * @param $name
     *
     * @return \Game\CharacterBundle\Entity\Character
     */
    public function findByName($name)
    {
        return $this->getRepository()->findByName($name);
    }

    /**
     * @param $name
     *
     * @return \Game\CharacterBundle\Entity\Character
     */
    public function findByNameWithPoi($name)
    {
        return $this->getRepository()->findByNameWithPoi($name);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->getRepository()->findById($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findCharacterWithMap($id)
    {
        return $this->getRepository()->findCharacterWithMap($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findByIdForStatus($id)
    {
        return $this->getRepository()->findByIdForStatus($id);
    }

    /**
     * @param Attributes $char
     * @param $defense
     * @internal param $weapons
     * @return BattleAttack
     */
    public function rollAttack(Attributes $char, $defense)
    {
        $weapons = $this->characterItemManager->getWeaponManager()->getEquippedWeapons($char);
        $damage = 0;
        $critical = 0;
        $hits = 0;
        $miss = 0;
        //ataque con armas
        if (count($weapons) > 0) {
            foreach ($weapons as $weapon) {
                $attackRoll = $this->rollManager->roll(1, 20, $weapon->getCriticalChance());
                //critico = daño maximo
                if ($attackRoll->getIsCritical()) {
                    $damage += (($weapon->getDamageDiceNumber() * $weapon->getDamageDice()) + $char->getDamage()) * $weapon->getCriticalMultiplier();
                    $critical++;
                    $hits++;
                } else {
                    // impacta? Attk >= Def
                    if (($attackRoll->getRollResult() + $char->getDex()) >= $defense) {
                        $damage += $this->characterItemManager->getWeaponManager()->rollDamage($weapon)->getRollResult() + $char->getDamage();
                        $hits++;
                    } else {
                        $miss++;
                    }
                }
            }
        } else { //unnarmed attack
            $attackRoll = $this->rollManager->roll(1, 20, 5);

            if ($attackRoll->getIsCritical()) {
                $damage = 5;
                $hits++;
            } else {
                if ($attackRoll->getRollResult() + $char->getDex() >= $defense) {
                    $hits++;
                    $damage = $char->getDamage();
                } else {
                    $miss++;
                }
            }
        }

        $battleAttack = new BattleAttack();
        $battleAttack->setCriticals($critical);
        $battleAttack->setDamage($damage);
        $battleAttack->setHits($hits);
        $battleAttack->setMiss($miss);
        return $battleAttack;
    }
}
