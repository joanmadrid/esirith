<?php

namespace Game\CharacterBundle\EventListener;


use Game\CharacterBundle\Event\CharacterEvent;

class CharacterShopListener
{
    public function __construct()
    {
    }

    /**
     * Se le resta el dinero de la compra a un personaje
     *
     * @param CharacterEvent $event
     */
    public function onCharacterBuy(CharacterEvent $event)
    {
        $gold = $event->getBuyout()->getGoldLeft();
        $event->getCharacter()->setGold($gold);
    }

    /**
     * Se le suma el dinero de la venta a un personaje
     *
     * @param CharacterEvent $event
     */
    public function onCharacterSell(CharacterEvent $event)
    {
        $gold = $event->getBuyout()->getGoldLeft();
        $event->getCharacter()->setGold($gold);
    }
}
