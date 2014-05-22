<?php

namespace Game\CharacterBundle\Controller;

use Game\UserBundle\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CharacterController extends Controller
{
    /**
     * @Route("/sheet", name="character.sheet")
     * @Template()
     */
    public function sheetAction()
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