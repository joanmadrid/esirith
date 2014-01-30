<?php

namespace Game\CharacterBundle\EventListener;

use Game\CharacterBundle\Event\CharacterEvent;
use Game\MapBundle\Manager\RestPointManager;

class CharacterRestoreListener
{
    public function __construct()
    {
    }

    /**
     * @param CharacterEvent $event
     */
    public function onCharacterTravel(CharacterEvent $event)
    {
        $character = $event->getCharacter();
        $event->setCharacterRestore($character->restore());
    }

    /**
     * @param CharacterEvent $event
     */
    public function onCharacterRest(CharacterEvent $event)
    {
        //gamedo: hacer diferentes tipo de restore FULL, TRAVEL, SAFE, OK

        $character = $event->getCharacter();

        if ($event->getRestType() == RestPointManager::REST_RESULT_SAFE) {
            $event->setCharacterRestore($character->restore());
        } else if ($event->getRestType() == RestPointManager::REST_RESULT_OK) {
            $event->setCharacterRestore($character->restore());
        }
    }
}
