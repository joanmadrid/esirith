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

        // default dead check
        if ($char->checkIsDead()) {
            return $this->redirect($this->generateUrl('character.death'));
        }

        return array(
            'character' => $char
        );
    }

    /**
     * @Route("/death", name="character.death")
     * @Template()
     */
    public function deathAction()
    {
        $char = $this->getUserManager()->getCharacter();

        //por alguna razon no esta marcado, aprovechamos para guardar
        if (!$char->getDead() && $char->checkIsDead()) {
            $char->setDead(true);
            $this->getUserManager()->persist($char);
            $this->getUserManager()->flush();
        } elseif (!$char->getDead()) {
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
