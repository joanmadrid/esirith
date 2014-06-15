<?php

namespace Game\QuestBundle\Controller;

use Game\QuestBundle\Entity\Quest;
use Game\UserBundle\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class QuestController extends Controller
{
    /**
     * @Route("/", name="quest.index")
     * @ParamConverter("char", class="CharacterBundle:Character")
     * @Template()
     */
    public function indexAction()
    {
        $char = $this->getUserManager()->getCharacter();
        return array(
            'char' => $char
        );
    }

    /**
     * @Route("/test/{id}", name="quest.test")
     * @ParamConverter("quest", class="QuestBundle:Quest")
     * @Template()
     */
    public function testAction(Quest $quest)
    {
        return $this->redirect($this->generateUrl('quest.index'));
    }

    /**
     * @return UserManager;
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }
}
