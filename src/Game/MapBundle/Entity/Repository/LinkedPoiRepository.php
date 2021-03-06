<?php

namespace Game\MapBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Game\MapBundle\Entity\Poi;

/**
 * LinkedPoiRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LinkedPoiRepository extends EntityRepository
{
    public function findLinkToPoi(Poi $start, Poi $end)
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->where('p.start = :start')
            ->andWhere('p.end = :end')
            ->setParameters(array(':start' => $start, ':end' => $end));

        return $qb->getQuery()->getOneOrNullResult();
    }
}
