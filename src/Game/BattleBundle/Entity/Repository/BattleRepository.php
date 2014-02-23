<?php

namespace Game\BattleBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Game\CharacterBundle\Entity\Character;
use Game\BattleBundle\Entity\Battle;

/**
 * BattleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BattleRepository extends EntityRepository
{
    /**
     * @param Character $char
     * @return mixed
     */
    public function getActiveBattle(Character $char)
    {
        $qb = $this->createQueryBuilder('battle');
        $qb
            ->select('battle, battleMonsters, monster')
            ->innerJoin('battle.battleMonsters', 'battleMonsters')
            ->innerJoin('battleMonsters.monster', 'monster')
            ->where('battle.character = :char')
            ->andWhere('battle.status = :status')
            ->setParameter(':status', Battle::STATUS_PENDING)
            ->setParameter(':char', $char);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
