<?php
namespace Game\MapBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Game\MapBundle\Entity\Map;
//use Game\MapBundle\Entity\Path;
use Game\MapBundle\Entity\Poi;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $map = new Map();
        $map->setName('Mapa del mundo');
        $map->setFilename('map.png');
        $manager->persist($map);

        $poi1 = new Poi();
        $poi1->setName('Wyvernstone');
        $poi1->setX(145);
        $poi1->setY(620);
        $poi1->setMap($map);
        $manager->persist($poi1);


        $poi2 = new Poi();
        $poi2->setName('Cruce de Shadewood');
        $poi2->setX(278);
        $poi2->setY(554);
        $poi2->setMap($map);
        $manager->persist($poi2);

        $manager->flush();

        $this->addReference('poi-start', $poi1);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
