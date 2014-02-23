<?php

namespace Game\MonsterBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Game\MapBundle\Entity\Poi;

class SpawnRepository extends EntityRepository
{
    /**
     * @param Poi $poi
     * @return array
     */
    public function findSpawnsFromPoi(Poi $poi)
    {
        $qb = $this->createQueryBuilder('spawn');
        $qb
            ->select('spawn, monster')
            ->innerJoin('spawn.monster', 'monster')
            ->where('spawn.poi = :poi')
            ->setParameter(':poi', $poi);

        return $qb->getQuery()->getResult();
    }
}
