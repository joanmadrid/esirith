<?php

namespace Game\CharacterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Game\UserBundle\Manager\UserManager;
use Game\CharacterBundle\Entity\Character;

class RosterController extends Controller
{
    /**
     * @Route("/index", name="character.roster.index")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->getUserManager()->getCurrentUser();
        return array(
            'user' => $user
        );
    }

    /**
     * @Route("/select/{id}", name="character.roster.select", requirements={"id" = "\d+"})
     * @Template()
     * @ParamConverter("char", class="CharacterBundle:Character")
     */
    public function selectAction(Character $char)
    {
        $this->getUserManager()->selectCharacter($char);
        return $this->redirect($this->generateUrl('map.view'));
    }

    /**
     * @return UserManager;
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }
}