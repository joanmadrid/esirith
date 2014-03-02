<?php

namespace Game\CharacterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Game\CharacterBundle\Manager\XPManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Game\UserBundle\Manager\UserManager;

class LevelUpController extends Controller
{
    /**
     * @Route("/", name="character.levelup.index")
     * @Template()
     */
    public function indexAction()
    {
        $char = $this->getUserManager()->getCharacter();

        return array();
    }

    /**
     * @Route("/upgrade/{type}", name="character.levelup.upgrade", requirements={"type" = "\d+"})
     */
    public function upgradeAction($type)
    {
        $char = $this->getUserManager()->getCharacter();

        if(!$this->getXPManager()->isReadyToLevelUp($char)) {
            throw new NotFoundHttpException();
        }

        $this->getXPManager()->levelUp($char, $type);
        $this->getXPManager()->flush();

        return $this->redirect($this->generateUrl('map.view'));
    }

    /**
     * @return XPManager
     */
    private function getXPManager()
    {
        return $this->get('character.xp_manager');
    }

    /**
     * @return UserManager;
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }
}