<?php

namespace Game\CharacterBundle\EventListener;

use Game\CharacterBundle\Event\CharacterEvent;
use Game\CharacterBundle\Manager\XPManager;

class CharacterXPListener
{
    /** @var XPManager */
    protected $XPManager;

    public function __construct()
    {
    }

    /**
     * @param XPManager $XPManager
     */
    public function setXPManager($XPManager)
    {
        $this->XPManager = $XPManager;
    }

    public function onCharacterKill(CharacterEvent $event)
    {
        //$xp = $this->XPManager->calcKillXP($event->getCharacter(), $event->getMonster());

    }
}
