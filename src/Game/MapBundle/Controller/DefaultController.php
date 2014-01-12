<?php

namespace Game\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Game\MapBundle\Entity\Map;

class DefaultController extends Controller
{
    /**
     * @Route("/test/{id}", name="map_test")
     * @Template()
     * @ParamConverter("map", class="GameMapBundle:Map")
     */
    public function testAction(Map $map)
    {
        return array(
            'map' => $map
        );
    }
}
