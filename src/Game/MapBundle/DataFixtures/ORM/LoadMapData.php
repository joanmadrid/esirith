<?php
namespace Game\MapBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Game\MapBundle\Entity\Map;
use Game\MapBundle\Entity\Path;
use Game\MapBundle\Entity\Poi;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //mapas
        $map = new Map();
        $map->setName('Mapa del mundo');
        $map->setFilename('map.png');
        $manager->persist($map);

        //pois
        $data = array();
        $data[0] = array('Wyvernstone', 145, 620);
        $data[1] = array("Shadewood's crossroad", 278, 554);
        $data[2] = array('Addelost', 304, 507);
        $data[3] = array('Tibby', 312, 619);
        $data[4] = array('Southward Keep', 366, 663);
        $data[5] = array('Elmswell', 460, 588);
        $data[6] = array('Shadewood', 344, 562);
        $data[7] = array('Ruined tower', 205, 527);

        $out = array();
        foreach ($data as $poi) {
            $aux = new Poi();
            $aux->setName($poi[0]);
            $aux->setX($poi[1]);
            $aux->setY($poi[2]);
            $aux->setMap($map);
            $manager->persist($aux);
            $out[] = $aux;
        }

        //paths (para los 2 lados)
        $paths = array();
        $paths[] = array(0, 1);
        $paths[] = array(0, 7);
        $paths[] = array(1, 2);
        $paths[] = array(1, 3);
        $paths[] = array(1, 6);
        $paths[] = array(1, 7);
        $paths[] = array(2, 5);
        $paths[] = array(2, 6);
        $paths[] = array(2, 7);
        $paths[] = array(3, 4);
        $paths[] = array(3, 5);
        $paths[] = array(4, 5);

        foreach ($paths as $path) {
            $aux = new Path();
            $aux->setDanger(10.0);
            $aux->setStart($out[$path[0]]);
            $aux->setEnd($out[$path[1]]);
            $manager->persist($aux);

            $aux = new Path();
            $aux->setDanger(10.0);
            $aux->setStart($out[$path[1]]);
            $aux->setEnd($out[$path[0]]);
            $manager->persist($aux);
        }

        $manager->flush();

        $this->addReference('poi-start', $out[0]);
        $this->addReference('poi-city', $out[2]);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
