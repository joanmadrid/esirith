<?php

namespace Game\UserBundle\Manager;

use Game\UserBundle\Entity\Repository\UserRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\SecurityContext;
use Game\CharacterBundle\Entity\Character;
use Game\CharacterBundle\Manager\CharacterManager;

use FOS\UserBundle\Doctrine\UserManager as FOSUserManager;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class UserManager extends CoreManager
{
    const CHARACTER_ID = 'character_id';

    /** @var SecurityContext */
    protected $securityContext;

    /** @var FOSUserManager */
    protected $fosUserManager;

    /** @var Session */
    protected $session;

    /** @var CharacterManager */
    protected $characterManager;

    /**
     * @return UserRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @param SecurityContext $securityContext
     */
    public function setSecurityContext($securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * @return SecurityContext
     */
    public function getSecurityContext()
    {
        return $this->securityContext;
    }

    /**
     * @param $fosUserManager
     */
    public function setFOSUserManager($fosUserManager)
    {
        $this->fosUserManager = $fosUserManager;
    }

    /**
     * @return UserManager
     */
    public function getFosUserManager()
    {
        return $this->fosUserManager;
    }

    /**
     * @param Session $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param CharacterManager $characterManager
     */
    public function setCharacterManager($characterManager)
    {
        $this->characterManager = $characterManager;
    }

    /**
     * @return CharacterManager
     */
    public function getCharacterManager()
    {
        return $this->characterManager;
    }


    /**
     * @return User
     */
    public function getCurrentUser()
    {
        return $this->getSecurityContext()->getToken()->getUser();
    }

    /**
     * Select character and update the date
     *
     * @param Character $char
     * @throws NotFoundHttpException
     */
    public function selectCharacter(Character $char)
    {
        if ($char->getUser() == $this->getCurrentUser() && !$char->getDead()) {
            $this->getSession()->set(self::CHARACTER_ID, $char->getId());
            $char->setLastConnection(new \DateTime());
            $this->persist($char);
        } else {
            throw new NotFoundHttpException();
        }
    }

    /**
     *
     */
    public function unselectCharacter()
    {
        $this->getSession()->remove(self::CHARACTER_ID);
    }

    /**
     * @return Character
     */
    public function getCharacter()
    {
        return $this->getCharacterManager()->findById($this->getCharacterId());
    }

    /**
     * @return Character
     */
    public function getCharacterWithMap()
    {
        return $this->getCharacterManager()->findCharacterWithMap($this->getCharacterId());
    }

    /**
     * @return mixed
     * @throws \Symfony\Component\Translation\Exception\NotFoundResourceException
     */
    public function getCharacterId()
    {
        $character_id = $this->getSession()->get(self::CHARACTER_ID);
        if ($character_id > 0) {
            return $character_id;
        } else {
            return null;
            //throw new NotFoundResourceException();
        }
    }

}