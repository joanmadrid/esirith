<?php

namespace Game\ItemBundle\Manager;

use Game\ItemBundle\Entity\Repository\SpawnRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\MapBundle\Entity\Poi;

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

    public function spawnMonsters(Poi $poi)
    {
        return null;
    }
}