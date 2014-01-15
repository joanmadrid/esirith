<?php

namespace Game\MapBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
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
        $char = $this->getDoctrine()->getRepository('GameCharacterBundle:Character')->findOneByName('Conan');

        //miro si hay peligro
        $path = $this->getDoctrine()->getRepository('GameMapBundle:Map')->findPathToPoi($char->getCurrentPoi(), $poi);
        if (!$path) {
            throw $this->createNotFoundException('Path not found');
        }
        $danger = $path->getDanger();
        $diceRoll = mt_rand(1, 100);
        $triggerCombat = $diceRoll < $danger;

        //guardo nueva posicion
        $char->setCurrentPoi($poi);
        $em->persist($char);
        $em->flush();

        return array(
            'char' => $char,
            'poi' => $poi,
            'dice' => $diceRoll,
            'danger' => $danger,
            'combat' => $triggerCombat
        );
    }
}
