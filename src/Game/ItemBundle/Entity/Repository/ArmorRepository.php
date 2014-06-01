<?php

namespace Game\ItemBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ArmorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArmorRepository extends EntityRepository
{
    /**
     * Devuelve las armaduras equipadas de un personaje
     *
     * @param $char
     * @return array
     */
    public function getEquippedArmor($char)
    {
        $qb = $this->createQueryBuilder('armor');
        $qb
            ->select('armor')
            ->innerJoin('armor.characterItems', 'charItem')
            ->innerJoin('charItem.character', 'char')
            ->where('char = :char')
            ->andWhere('charItem.equipped = :equipped')
            ->setParameter(':char', $char)
            ->setParameter(':equipped', true);

        return $qb->getQuery()->getOneOrNullResult();
    }
}