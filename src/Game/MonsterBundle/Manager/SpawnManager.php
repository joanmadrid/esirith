<?php

namespace Game\MonsterBundle\Manager;

use Game\ItemBundle\Entity\Repository\SpawnRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\MapBundle\Entity\Poi;
use Game\MonsterBundle\Entity\Monster;
use Game\MonsterBundle\Model\MonsterGroup;
use Game\MonsterBundle\Model\MonsterGroupItem;

class SpawnManager extends CoreManager
{
    const DEFAULT_MONSTER_MIN = 1;
    const DEFAULT_MONSTER_MAX = 3;

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
     * Genera aleatoriamente un grupo de monstruos siguiendo una SpawnList
     *
     * @param Poi $poi
     * @return MonsterGroup
     */
    public function spawnMonsters(Poi $poi)
    {
        $spawns = $this->findSpawnsFromPoi($poi);

        $monsters = new MonsterGroup();

        foreach ($spawns as $spawn)
        {
            if ($this->rollManager->rollPercentEqualOrBelow($spawn->getRate())) {
                $monsters->addMonster($spawn->getMonster(), mt_rand($spawn->getMin(), $spawn->getMax()));
            }
        }

        if (count($monsters->getMonsters()) == 0) {
            $monsters->addMonster(
                $this->getDefaultMonster(),
                mt_rand(self::DEFAULT_MONSTER_MIN, self::DEFAULT_MONSTER_MAX)
            );
        }

        return $monsters;
    }

    /**
     * @return Monster
     */
    public function getDefaultMonster()
    {
        return $this->getManager()->getRepository('MonsterBundle:Monster')->findMinimumLevelMonster();
    }

    /**
     * @param Poi $poi
     */
    public function findSpawnsFromPoi(Poi $poi)
    {
        return $this->getRepository()->findSpawnsFromPoi($poi);
    }
}