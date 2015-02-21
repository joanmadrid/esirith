<?php
namespace Game\CharacterBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Game\CharacterBundle\Entity\CharacterClass;

class LoadCharacterClassData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $list = array(        //hp  dmg def str dex int spi man
            array('Warrior',    20, 3,  10, 12, 9,  5,  5,  0),
            array('Archer',     20, 3,  8,  10, 12, 5,  6,  0),
            array('Mage',       10, 6,  5,  5,  10, 10, 8,  100),
            array('Cleric',     15, 3,  10, 10, 8,  8,  10, 100)
        );

        foreach ($list as $item) {
            $class = new CharacterClass();
            $class
                ->setName($item[0])
                ->setHp($item[1])
                ->setCurrentHp($item[1])
                ->setDamage($item[2])
                ->setDefense($item[3])
                ->setStr($item[4])
                ->setDex($item[5])
                ->setInt($item[6])
                ->setSpi($item[7])
                ->setMana($item[8])
                ->setCurrentMana($item[8])
                ->setLevel(1)
            ;
            $manager->persist($class);
            $this->addReference('class-'.strtolower($item[0]), $class);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
