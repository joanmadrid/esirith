<?php

namespace Game\BattleBundle\Manager;

use Game\BattleBundle\Entity\BattleMonster;
use Game\BattleBundle\Entity\Repository\BattleRepository;
use Game\BattleBundle\Model\BattleResult;
use Game\CharacterBundle\Entity\Character;
use Game\CoreBundle\Manager\CoreManager;
use Game\MapBundle\Entity\Poi;
use Game\MonsterBundle\Entity\Monster;
use Game\MonsterBundle\Model\MonsterGroup;
use Game\BattleBundle\Entity\Battle;

class BattleManager extends CoreManager
{
    /** @var BattleResolver */
    protected $battleResolver;

    /**
     * @return BattleRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @param \Game\BattleBundle\Manager\BattleResolver $battleResolver
     */
    public function setBattleResolver($battleResolver)
    {
        $this->battleResolver = $battleResolver;
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
        //gamedo: mirar que no tenga una ya creada
        $battle = new Battle();
        $battle->setCharacter($char);
        $battle->setStatus(Battle::STATUS_PENDING);

        foreach ($monsters as $monsterItem)
        {
            $battleMonster = new BattleMonster();
            $battleMonster->setMonster($monsterItem->getMonster());
            $battleMonster->setNumber($monsterItem->getNumber());
            $battleMonster->setBattle($battle);
            $battle->addBattleMonster($battleMonster);
            $this->persist($battleMonster);
        }
        $this->persist($battle);

        return $battle;
    }

    /**
     * @param Character $char
     * @return mixed
     */
    public function getActiveBattle(Character $char)
    {
        return $this->getRepository()->getActiveBattle($char);
    }

    /**
     * @param Battle $battle
     * @return BattleResult
     */
    public function resolveBattle(Battle $battle)
    {
        $char = $battle->getCharacter();

        $resolver = $this->battleResolver;
        $resolver->setBattle($battle);
        $result = $resolver->resolve();

        //guardo la resolución
        $battle->setStatus($result->getStatus());
        $battle->setResolution($result->generateJSON());
        $this->persist($battle);

        //xp
        $char->addXP($result->getGainedXP());
        $this->persist($char);

        return $result;
    }
}
