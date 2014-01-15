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
     * @Route("/view/{id}", name="map.view")
     * @Template()
     * @ParamConverter("map", class="GameMapBundle:Map")
     */
    public function viewAction(Map $map)
    {
        //personaje activo
        $char = $this->getDoctrine()->getRepository('GameCharacterBundle:Character')->findOneByName('Conan');

        return array(
            'char' => $char,
            'map' => $map
        );
    }
}
