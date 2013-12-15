<?php

namespace Game\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/test", name="map_test")
     */
    public function testAction()
    {
        return $this->render('GameMapBundle:Default:test.html.twig');
    }
}
