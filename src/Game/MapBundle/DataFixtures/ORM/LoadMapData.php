<?php
namespace Game\MapBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Game\MapBundle\Entity\Map;
//use Game\MapBundle\Entity\Path;
use Game\MapBundle\Entity\Poi;

class LoadUserData implements FixtureInterface
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

        $poi = new Poi();
        $poi->setName('Wyvernstone');
        $poi->setX(145);
        $poi->setY(620);
        $poi->setMap($map);
        $manager->persist($poi);

        $poi = new Poi();
        $poi->setName('Cruce de Shadewood');
        $poi->setX(278);
        $poi->setY(554);
        $poi->setMap($map);
        $manager->persist($poi);

        $manager->flush();
    }
}
