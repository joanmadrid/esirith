<?php

namespace Game\MapBundle\Manager;

use Game\CharacterBundle\Entity\Character;
use Game\CoreBundle\Manager\CoreManager;
use Game\MapBundle\Entity\Repository\TreasureRepository;
use Game\MapBundle\Entity\Treasure;

class TreasureManager extends CoreManager
{
    const FIND_CHANCE = 100;//%

    /**
     * @param Character $char
     * @return mixed
     */
    public function findForTreasures(Character $char)
    {
        $poi = $char->getCurrentPoi();
        $treasure = $this->getRepository()->getTreasureFromPoi($poi);

        if ($treasure) {
            $chance = self::FIND_CHANCE;
            if (mt_rand(1, 100) <= $chance) {
                return $treasure;
            }
        }
        return null;
    }

    /**
     * @param Character $char
     * @param Treasure $treasure
     * @return bool
     * gamedo: con esto pueden "hackear" provando por URL, de alguna manera deberiamos controlar que lo hayan encontrado antes
     */
    public function open(Character $char, Treasure $treasure)
    {
        $poi = $char->getCurrentPoi();
        $treasure = $this->getRepository()->getTreasureFromPoi($poi);

        if ($treasure) {
            $treasure->setOpened(true);
            $treasure->setOpenedBy($char);
            $this->persist($treasure);

            $char->addGold($treasure->getGold());
            $this->persist($char);
            return true;
        } else {
            return false;
        }

    }

    /**
     * @return TreasureRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }
} 