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
        $this->restore($event, 1);
    }

    /**
     * @param CharacterEvent $event
     */
    public function onCharacterRest(CharacterEvent $event)
    {
        $toRestore = 0;

        switch ($event->getRestType()) {
            case RestPointManager::REST_RESULT_SAFE:
                $toRestore = 100;
                break;
            case RestPointManager::REST_RESULT_OK:
                $toRestore = rand(10, 100);
                break;
        }

        $this->restore($event, $toRestore);
    }

    /**
     * @param CharacterEvent $event
     * @param $toRestore
     */
    private function restore($event, $toRestore)
    {
        $character = $event->getCharacter();
        $character->restore($toRestore);
        $event->setRestored($toRestore);
    }
}
