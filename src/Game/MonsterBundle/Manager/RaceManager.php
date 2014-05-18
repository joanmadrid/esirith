<?php

namespace Game\MonsterBundle\Manager;

use Game\CoreBundle\Manager\CoreManager;
use Game\MonsterBundle\Entity\Race;

class RaceManager extends CoreManager
{
    /**
     * @return ItemRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @return array
     */
    public function getSelectableRaces()
    {
        return $this->getRepository()->findRaces(true);
    }

    /**
     * @param $raceId
     * @return Race
     */
    public function findRace($raceId)
    {
        return $this->getRepository()->findOneById($raceId);
    }
}
