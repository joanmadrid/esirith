<?php

namespace Game\MonsterBundle\Manager;

use Game\ItemBundle\Entity\Repository\SpawnRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\MapBundle\Entity\Poi;
use Game\MonsterBundle\Model\MonsterGroup;
use Game\MonsterBundle\Model\MonsterGroupItem;

class SpawnManager extends CoreManager
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

        return $monsters;
    }

    /**
     * @param Poi $poi
     */
    public function findSpawnsFromPoi(Poi $poi)
    {
        return $this->getRepository()->findSpawnsFromPoi($poi);
    }
}