<?php

namespace Game\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Game\MapBundle\Entity\Poi;
use Game\CharacterBundle\Entity\Character;

class TravelController extends Controller
{
    /**
     * @Route("/to/{id}", name="map.travel.to")
     * @Template()
     * @ParamConverter("poi", class="GameMapBundle:Poi")
     */
    public function toAction(Poi $poi)
    {
        $em = $this->getDoctrine()->getManager();

        //personaje activo
        $char = $this->getDoctrine()->getRepository('GameCharacterBundle:Character')->find(1);

        //guardo nueva posicion
        $char->setCurrentPoi($poi);
        $em->persist($char);
        $em->flush();

        return array(
            'char' => $char,
            'poi' => $poi
        );
    }
}
