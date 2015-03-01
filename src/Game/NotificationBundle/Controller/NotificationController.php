<?php

namespace Game\NotificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Game\UserBundle\Manager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class NotificationController extends Controller
{
    /**
     * @Route("/index", name="notification.index")
     * @Template()
     */
    public function indexAction($name)
    {
        return array();
    }
}
