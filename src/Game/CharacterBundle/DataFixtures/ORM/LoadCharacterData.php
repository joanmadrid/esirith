<?php
namespace Game\CharacterBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Game\CharacterBundle\Entity\Character;
use Game\CharacterBundle\Entity\CharacterItem;

class LoadCharacterData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //gamedo: hacerlo por el service
        $char = new Character();
        $char
            ->setName('Conan')
            ->setHp(20)
            ->setCurrentHp(20)
            ->setDamage(3)
            ->setDefense(10)
            ->setStr(12)
            ->setDex(9)
            ->setLevel(1)
            ->setPortrait('human-male/0000.jpg')
            ->setCurrentPoi($this->getReference('poi-start'))
            ->setGold(1000)
            ->setUser($this->getReference('user-0'))
            ->setRace($this->getReference('race-human'))
            ->setClass($this->getReference('class-warrior'))
            ->setGame($this->getReference('game-test'))
        ;

        $manager->persist($char);

        $gear = new CharacterItem();
        $gear->setItem($this->getReference('weapon-long-sword'));
        $gear->setCharacter($char);
        $gear->setEquipped(true);
        $manager->persist($gear);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}
