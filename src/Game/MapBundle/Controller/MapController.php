<?php

namespace Game\MapBundle\Controller;

use Game\MapBundle\Manager\MapManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Game\MapBundle\Entity\Map;
use Game\MapBundle\Entity\RestPoint;
use Game\MapBundle\Manager\RestPointManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @ParamConverter("map", class="MapBundle:Map")
     */
    public function viewAction(Map $map)
    {
        //personaje activo
        $char = $this->getDoctrine()->getRepository('CharacterBundle:Character')->findOneByName('Conan');

        return array(
            'char' => $char,
            'map'  => $map
        );
    }

    /**
     * @Route("/rest/{id}/", name="map.rest", requirements={"id" = "\d+"})
     * @Template()
     * @ParamConverter("restPoint", class="MapBundle:RestPoint")
     */
    public function restAction(RestPoint $restPoint)
    {
        // gamedo: Recuperar el personaje de session
        $char = $this->getCharacterManager()->findByNameWithPoi('Conan');

        try {
            $restResult = $this->getRestPointManager()->getRestResult($char, $restPoint);

            $restore = null;
            if ($restResult == RestPointManager::REST_RESULT_OK || $restResult == RestPointManager::REST_RESULT_SAFE) {
                $restore = $this->getRestPointManager()->rest($char, $restResult)->getCharacterRestore();
            } else {
                // gamedo: batalla
            }

            $this->getRestPointManager()->flush();

            return array(
                'restPoint' => $restPoint,
                'restResult' => $restResult,
                'restore' => $restore
            );
        } catch (NotFoundHttpException $exc) {
            $characterMap = $char->getCurrentPoi()->getMap();
            return $this->redirect($this->generateUrl('map.view', array('id' => $characterMap->getId())));
        }

    }


    /**
     * @return MapManager
     */
    protected function mapManager()
    {
        return $this->get('map.map_manager');
    }

    /**
     * @return RestPointManager
     */
    protected function getRestPointManager()
    {
        return $this->get('map.restpoint_manager');
    }

    /**
     * @return CharacterManager
     */
    protected function getCharacterManager()
    {
        return $this->get('character.character_manager');
    }
}
