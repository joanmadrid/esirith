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
use Game\UserBundle\Manager\UserManager;
use Game\CharacterBundle\Entity\Character;

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
     * @Route("/view", name="map.view")
     * @Template()
     */
    public function viewAction()
    {
        //personaje activo
        /** @var Character $char */
        $char = $this->getUserManager()->getCharacterWithMap();

        $map = $char->getCurrentPoi()->getMap();

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
        $char = $this->getUserManager()->getCharacter();

        try {
            $restResult = $this->getRestPointManager()->getRestResult($char, $restPoint);

            $restore = null;
            if ($restResult == RestPointManager::REST_RESULT_OK || $restResult == RestPointManager::REST_RESULT_SAFE) {
                $restore = $this->getRestPointManager()->rest($char, $restResult)->getRestored();
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
            return $this->redirect($this->generateUrl('map.view'));
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

    /**
     * @return UserManager;
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }
}
