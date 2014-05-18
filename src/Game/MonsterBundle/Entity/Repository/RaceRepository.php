<?php

namespace Game\MonsterBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class RaceRepository extends EntityRepository
{
    /**
     * @param bool $selectableOnly
     * @return array
     */
    public function findRaces($selectableOnly = false)
    {
        $qb = $this->createQueryBuilder('race');
        $qb->select('race');

        if ($selectableOnly) {
            $qb->where('race.selectable = :selectable')
                ->setParameter(':selectable', true);
        }

        return $qb->getQuery()->getArrayResult();
    }
}
