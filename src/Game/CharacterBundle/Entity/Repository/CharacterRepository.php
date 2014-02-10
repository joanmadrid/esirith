<?php

namespace Game\CharacterBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Game\CharacterBundle\Entity\Character;

/**
 */
class CharacterRepository extends EntityRepository
{
    /**
     * @param $name String
     * @return Character
     */
    public function findByName($name)
    {
        $qb = $this->createQueryBuilder('char');
        $qb
            ->where('char.name = :name')
            ->setParameter(':name', $name);

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * @param $name String
     * @return Character
     */
    public function findByNameWithPoi($name)
    {
        $qb = $this->createQueryBuilder('char');
        $qb
            ->select('char, poi, map')
            ->innerJoin('char.currentPoi', 'poi')
            ->innerJoin('poi.map', 'map')
            ->where('char.name = :name')
            ->setParameter(':name', $name);

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $qb = $this->createQueryBuilder('char');
        $qb
            ->where('char.id = :id')
            ->setParameter(':id', $id);

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findByIdForStatus($id)
    {
        $qb = $this->createQueryBuilder('char');
        $qb
            ->select('char, poi')
            ->innerJoin('char.currentPoi', 'poi')
            ->where('char.id = :id')
            ->setParameter(':id', $id);

        return $qb->getQuery()->getSingleResult();
    }
}
