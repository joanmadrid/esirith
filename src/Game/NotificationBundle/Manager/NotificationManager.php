<?php

namespace Game\NotificationBundle\Manager;

use Game\CoreBundle\Manager\CoreManager;
use Game\GameBundle\Entity\Game;
use Game\NotificationBundle\Entity\Notification;
use Game\NotificationBundle\Entity\Repository\NotificationRepository;
use Game\UserBundle\Entity\User;

class NotificationManager extends CoreManager
{
    /**
     * @return NotificationRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @param Game $game
     * @param $title
     * @param $body
     * @return Notification
     */
    public function sendToGame(Game $game, $title, $body)
    {
        $noti = new Notification();
        $noti->setGame($game);
        $noti->setSent(new \DateTime());
        $noti->setTitle($title);
        $noti->setBody($body);
        $this->persist($noti);
        return $noti;
    }

    /**
     * @param Game $game
     * @param User $user
     * @param $title
     * @param $body
     * @return Notification
     */
    public function sendToCharacter(Game $game, User $user, $title, $body)
    {
        $noti = new Notification();
        $noti->setGame($game);
        $noti->setUser($user);
        $noti->setSent(new \DateTime());
        $noti->setTitle($title);
        $noti->setBody($body);
        $this->persist($noti);
        return $noti;
    }

    /**
     * @param $game
     * @param $user
     * @internal param $character
     * @return array
     */
    public function getFromCharacter($game, $user)
    {
        return $this->getRepository()->getFromCharacter($game, $user);
    }

    /**
     * @param $user
     * @return array
     */
    public function getFromUser($user)
    {
        return $this->getRepository()->getFromUser($user);
    }

    /**
     * @param $game
     * @return array
     */
    public function getFromGame($game)
    {
        return $this->getRepository()->getFromGame($game);
    }
}
