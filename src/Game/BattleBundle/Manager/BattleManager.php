<?php

namespace Game\BattleBundle\Manager;


use Game\CharacterBundle\Entity\Character;
use Game\CoreBundle\Manager\CoreManager;
use Game\MapBundle\Entity\Poi;
use Game\MonsterBundle\Entity\Monster;
use Game\BattleBundle\Entity\Battle;
use Game\MonsterBundle\Model\MonsterGroup;

class BattleManager extends CoreManager
{

    /**
     * @return BattleRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * Crea una batalla PvM
     *
     * @param Character $char
     * @param MonsterGroup $monsters
     * @param Poi $poi
     * @return Battle
     */
    public function createMonsterBattle(Character $char, MonsterGroup $monsters, Poi $poi)
    {
        return new Battle();
    }


}
