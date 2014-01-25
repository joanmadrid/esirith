<?php

namespace Game\MapBundle\Controller;

use Game\MapBundle\Manager\MapManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Game\MapBundle\Entity\Map;

class MapController extends Controller
{

    /**
     * @Route("/list/", name="map.list")
     * @Template()
     */
    public function listAction()
    {
        $mapList = $this->mapManager()->findAll();

        return array(
            'mapList' => $mapList
        );

    }

    /**
     * @Route("/view/{id}/", name="map.view", requirements={"id" = "\d+"}, defaults={"id" = 1})
     * @Template()
     * @ParamConverter("map", class="GameMapBundle:Map")
     */
    public function viewAction(Map $map)
    {
        //personaje activo
        $char = $this->getDoctrine()->getRepository('GameCharacterBundle:Character')->findOneByName('Conan');

        return array(
            'char' => $char,
            'map'  => $map
        );
    }


    /**
     * @return MapManager
     */
    protected function mapManager()
    {
        return $this->get('map.map_manager');
    }
}
