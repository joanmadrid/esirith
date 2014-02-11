<?php

namespace Game\CharacterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
//use Symfony\Component\HttpFoundation\Response;
use Game\UserBundle\Manager\UserManager;
USE Game\CharacterBundle\Manager\CharacterManager;
//use Game\CharacterBundle\Entity\Character;

class StatusController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        $charId = $this->getUserManager()->getCharacterId();
        if ($charId) {
            $char = $this->getCharacterManager()->findByIdForStatus($charId);
        } else {
            $char = null;
        }

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

    /**
     * @return CharacterManager
     */
    protected function getCharacterManager()
    {
        return $this->get('character.character_manager');
    }
}