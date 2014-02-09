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
        $char = new Character();
        $char
            ->setName('Conan')
            ->setHp(20)
            ->setCurrentHp(20)
            ->setDamage(3)
            ->setDefense(10)
            ->setFue(12)
            ->setDes(9)
            ->setLevel(1)
            ->setCurrentPoi($this->getReference('poi-start'))
            ->setGold(100)
            ->setUser($this->getReference('user-0'));

        $manager->persist($char);

        $gear = new CharacterItem();
        $gear->setItem($this->getReference('weapon-long-sword'));
        $gear->setCharacter($char);
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
