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
            ->setCurrentPoi($this->getReference('poi-start'));

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
