<?php

namespace Game\CharacterBundle\Controller;

use Game\CharacterBundle\Entity\Character;
use Game\UserBundle\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
     * @Route("/death/{id}", name="character.death")
     * @ParamConverter("char", class="CharacterBundle:Character")
     * @Template()
     */
    public function deathAction(Character $char)
    {
        if (!$char->getDead()) {
            throw new AccessDeniedException('This char is not dead');
        }
        return array('char'=>$char);
    }

    /**
     * @return UserManager;
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }
}
