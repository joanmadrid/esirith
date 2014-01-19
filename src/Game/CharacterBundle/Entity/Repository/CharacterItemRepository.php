<?php

namespace Game\CharacterBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Game\CharacterBundle\Entity\Character;
//use Game\CharacterBundle\Entity\CharacterItem;

/**
 * CharacterItemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CharacterItemRepository extends EntityRepository
{
    /**
     * Devuelve los items de un personaje
     *
     * @param $char
     * @return array
     */
    public function findItemsByCharacter($char)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT
                    ci, it
                FROM
                    GameCharacterBundle:CharacterItem ci
                JOIN
                    ci.item it
                WHERE
                    ci.character = :char'
            )
            ->setParameter('char', $char)
            ->getResult();
    }
}