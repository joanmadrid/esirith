<?php

namespace Game\CharacterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
//use Symfony\Component\HttpFoundation\Response;
use Game\UserBundle\Manager\UserManager;
//use Game\CharacterBundle\Entity\Character;

class StatusController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        $char = $this->getUserManager()->getCharacter();

        return array(
            'character' => $char
        );
    }

    /**
     * @return UserManager;
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }
}