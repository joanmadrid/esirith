<?php

namespace Game\CharacterBundle\EventListener;


use Game\CharacterBundle\Event\CharacterEvent;

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
}
