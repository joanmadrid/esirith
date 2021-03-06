<?php

namespace Game\CharacterBundle\Manager;

use Game\CharacterBundle\Entity\Character;
use Game\CharacterBundle\Entity\CharacterClass;
use Game\CharacterBundle\Entity\Repository\CharacterRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\GameBundle\Entity\Game;
use Game\MapBundle\Entity\Poi;
use Game\UserBundle\Entity\User;

class RosterManager extends CoreManager
{
    /**
     * @return CharacterRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @param $name
     * @param $race
     * @param CharacterClass $class
     * @param User $user
     * @param Poi $poi
     * @param $portrait
     * @param Game $game
     * @return Character
     */
    public function createCharacter($name, $race, $class, User $user, $poi, $portrait, Game $game)
    {
        $character = new Character();
        $character->setName($name);
        $character->setRace($race);
        $character->setUser($user);
        $character->setClass($class);
        $character->setPortrait($portrait);
        $character->setGame($game);

        $character
            ->setHp($class->getHp())
            ->setCurrentHp($class->getHp())
            ->setDamage($class->getDamage())
            ->setDefense($class->getDefense())
            ->setStr($class->getStr())
            ->setDex($class->getDex())
            ->setInt($class->getInt())
            ->setSpi($class->getSpi())
            ->setMana($class->getMana())
            ->setCurrentMana($class->getMana())
            ->setLevel(1)
            ->setGold(100)
            ->setCurrentPoi($poi);

        $this->persist($character);
        return $character;
    }
}
