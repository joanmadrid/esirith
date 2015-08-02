<?php

namespace Game\MapBundle\Controller;

use Game\CharacterBundle\Manager\CharacterManager;
use Game\GameBundle\Entity\Game;
use Game\GameBundle\Manager\BossManager;
use Game\MapBundle\Entity\Treasure;
use Game\MapBundle\Manager\MapManager;
use Game\MapBundle\Manager\TreasureManager;
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
     */
    public function viewAction()
    {
        //personaje activo
        /** @var Character $char */
        $char = $this->getUserManager()->getCharacterWithMap();
        $currPoi = $char->getCurrentPoi();
        $map = $currPoi->getMap();

        // default dead check
        if ($char->checkIsDead()) {
            return $this->redirect($this->generateUrl('character.death'));
        }

        // game lost check
        if ($char->getGame()->getStatus() == Game::STATUS_ENDED_LOST) {
            return $this->redirect($this->generateUrl('game.status.lost'));
        }

        $others = $this->getCharacterManager()->getCharactersInTheSamePoi(
            $char->getCurrentPoi(),
            $this->getUserManager()->getCurrentUser()
        );

        if ($currPoi->getInfected()) {
            return $this->render(
                'MapBundle:Map:view-infected.html.twig',
                array(
                    'char' => $char,
                    'map'  => $map,
                    'others' => $others
                )
            );
        } else {
            $treasure = $this->getTreasureManager()->findForTreasures($char);

            $boss = $this->getBossManager()->getBossFromPoi($currPoi);

            return $this->render(
                'MapBundle:Map:view.html.twig',
                array(
                    'char' => $char,
                    'map'  => $map,
                    'treasure' => $treasure,
                    'others' => $others,
                    'boss' => $boss
                )
            );
        }
    }

    /**
     * @Route("/rest/{id}/", name="map.rest", requirements={"id" = "\d+"})
     * @Template()
     * @ParamConverter("restPoint", class="MapBundle:RestPoint")
     */
    public function restAction(RestPoint $restPoint)
    {
        /** @var Character $char */
        $char = $this->getUserManager()->getCharacter();

        try {
            $restResult = $this->getRestPointManager()->getRestResult($char, $restPoint);

            if ($restPoint->getCost()) {
                $em = $this->getDoctrine()->getManager();
                if ($char->removeGold($restPoint->getCost())) {
                    $em->persist($char);
                    $em->flush();
                } else {
                    $this->get('session')->getFlashBag()->add(
                        'error',
                        'You don\'t have enough money'
                    );
                    return $this->redirect($this->generateUrl('map.view'));
                }
            }

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
     * @Route("/treasure/open/{id}/", name="map.open.treasure", requirements={"id" = "\d+"})
     * @Template()
     * @ParamConverter("treasure", class="MapBundle:Treasure")
     */
    public function openTreasureAction(Treasure $treasure)
    {
        $char = $this->getUserManager()->getCharacter();
        if ($this->getTreasureManager()->open($char, $treasure)) {
            $this->getTreasureManager()->flush();
            return array(
                'treasure' => $treasure
            );
        } else {
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

    /**
     * @return TreasureManager
     */
    private function getTreasureManager()
    {
        return $this->get('map.treasure_manager');
    }

    /**
     * @return BossManager
     */
    private function getBossManager()
    {
        return $this->get('game.boss_manager');
    }
}
