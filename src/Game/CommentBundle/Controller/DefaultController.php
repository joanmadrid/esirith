<?php

namespace Game\CommentBundle\Controller;

use Game\UserBundle\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class DefaultController extends Controller
{
    /**
     * @Route("/index", name="comment.index")
     * @Template()
     */
    public function indexAction()
    {
        $char = $this->getUserManager()->getCharacter();
        $game = $char->getGame();

        return array('game' => $game);
    }

    /**
     * @return UserManager;
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }
}
