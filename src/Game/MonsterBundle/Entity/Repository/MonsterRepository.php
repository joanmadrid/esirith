<?php

namespace Game\MonsterBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Game\MonsterBundle\Entity\Monster;

class MonsterRepository extends EntityRepository
{
    /**
     * @return Monster
     */
    public function findMinimumLevelMonster()
    {
        $qb = $this->createQueryBuilder('monster');
        $qb
            ->select('monster')
            ->orderBy('monster.level', 'ASC')
            ->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param $name
     * @return Monster
     */
    public function getByInternalName($name)
    {
        $qb = $this->createQueryBuilder('monster');
        $qb
            ->select('monster')
            ->where('monster.internalName = :name')
            ->setParameter(':name', $name);
        return $qb->getQuery()->getOneOrNullResult();
    }
}
