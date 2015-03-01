<?php

namespace Game\NotificationBundle\Controller;

use Game\NotificationBundle\Manager\NotificationManager;
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
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/character", name="notification.character")
     * @Template("NotificationBundle:Notification:notifications.html.twig")
     */
    public function characterNotificationsAction()
    {
        $user = $this->getUserManager()->getCurrentUser();
        $char = $this->getUserManager()->getCharacter();
        $game = $char->getGame();
        return array(
            'notifications' => $this->getNotificationManager()->getFromCharacter($game, $user)
        );
    }

    /**
     * @Route("/user", name="notification.user")
     * @Template("NotificationBundle:Notification:notifications.html.twig")
     */
    public function userNotificationsAction()
    {
        $user = $this->getUserManager()->getCurrentUser();
        return array(
            'notifications' => $this->getNotificationManager()->getFromUser($user)
        );
    }

    /**
     * @Route("/game", name="notification.game")
     * @Template("NotificationBundle:Notification:notifications.html.twig")
     */
    public function gameNotificationsAction()
    {
        $char = $this->getUserManager()->getCharacter();
        $game = $char->getGame();
        return array(
            'notifications' => $this->getNotificationManager()->getFromGame($game)
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
     * @return NotificationManager
     */
    private function getNotificationManager()
    {
        return $this->get('notification.notification_manager');
    }
}
