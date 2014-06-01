<?php

namespace Game\MapBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Game\MapBundle\Entity\Treasure;

class LoadTreasureData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $treasures = array(
            array('500', 'poi#12')
        );

        foreach ($treasures as $treasureInfo) {
            $treasure = new Treasure();
            $treasure->setGold($treasureInfo[0]);
            $treasure->setPoi($this->getReference($treasureInfo[1]));
            $manager->persist($treasure);
        }
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 8;
    }
}
