<?php

namespace Game\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Game\MapBundle\Entity\Map;
use Game\MapBundle\Entity\Poi;
use Game\MapBundle\Entity\Path;

class DefaultController extends Controller
{
    /**
     * @Route("/test", name="map_test")
     */
    public function testAction()
    {
        $map = new Map();
        $map->setName('Mapa del mundo');
        $map->setFilename('map.png');

        $poi = new Poi();
        $poi->setName('Wyvernstone');
        $poi->setX(145);
        $poi->setY(620);
        $map->addPoi($poi);

        $poi = new Poi();
        $poi->setName('Cruce de Shadewood');
        $poi->setX(278);
        $poi->setY(554);
        $map->addPoi($poi);

        $path = new Path();



        return $this->render('GameMapBundle:Default:test.html.twig',
            array(
                'map' => $map
            )
        );
    }
}
