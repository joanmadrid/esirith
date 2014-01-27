<?php
namespace Game\MapBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Game\MapBundle\Entity\Map;
use Game\MapBundle\Entity\Path;
use Game\MapBundle\Entity\Poi;
use Game\MapBundle\Entity\LinkedPoi;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //mapas
        $map = new Map();
        $map->setName('World map');
        $map->setFilename('map.png');
        $manager->persist($map);

        $dungeon = new Map();
        $dungeon->setName('Ruined tower dungeon');
        $dungeon->setFilename('dungeon1.jpg');
        $manager->persist($dungeon);

        //pois
        $data = array();
        $data[0] = array('Wyvernstone', 145, 620, $map);
        $data[1] = array("Shadewood's crossroad", 278, 554, $map);
        $data[2] = array('Addelost', 304, 507, $map);
        $data[3] = array('Tibby', 312, 619, $map);
        $data[4] = array('Southward Keep', 366, 663, $map);
        $data[5] = array('Elmswell', 460, 588, $map);
        $data[6] = array('Shadewood', 344, 562, $map);
        $data[7] = array('Ruined tower', 205, 527, $map);

        $data[8] = array('Entrance', 483, 534, $dungeon);
        $data[9] = array('Large room', 516, 422, $dungeon);
        $data[10] = array('Room', 498, 211, $dungeon);//
        $data[11] = array('Large room', 456, 422, $dungeon);
        $data[12] = array('Room', 390, 254, $dungeon);//
        $data[13] = array('Strange room', 296, 422, $dungeon);//

        $out = array();
        foreach ($data as $poi) {
            $aux = new Poi();
            $aux->setName($poi[0]);
            $aux->setX($poi[1]);
            $aux->setY($poi[2]);
            $aux->setMap($poi[3]);
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

        $paths[] = array(8, 9);
        $paths[] = array(8, 11);
        $paths[] = array(9, 10);
        $paths[] = array(11, 12);
        $paths[] = array(12, 13);

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

        //link entre mapas
        $linkeds = array();
        $linkeds[] = array("Entrance to the dungeon", 7, 8);
        $linkeds[] = array("Exit from the dungeon", 8, 7);

        foreach ($linkeds as $linked) {
            $aux = new LinkedPoi();
            $aux->setName($linked[0]);
            $aux->setStart($out[$linked[1]]);
            $aux->setEnd($out[$linked[2]]);
            $manager->persist($aux);
        }

        $manager->flush();

        $this->addReference('poi-start', $out[0]);
        $this->addReference('poi-city', $out[2]);

        // Añadimos todos los Poi's menos el inicial
        for ($i=1; $i<count($out); $i++) {
            $this->addReference('poi#' . ($i-1), $out[$i]);
        }

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
