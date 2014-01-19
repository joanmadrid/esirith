<?php

namespace Game\CharacterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class InventoryController extends Controller
{
    /**
     * @Route("/index", name="character.inventory.index")
     * @Template()
     */
    public function indexAction()
    {
        //personaje activo
        $char = $this->getDoctrine()->getRepository('GameCharacterBundle:Character')->findOneByName('Conan');

        //items
        $items = $this->getDoctrine()->getRepository('GameCharacterBundle:CharacterItem')->findItemsByCharacter($char);

        return array(
            'char' => $char,
            'items' => $items
        );
    }
}
