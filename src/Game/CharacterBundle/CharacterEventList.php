<?php

namespace Game\CharacterBundle;


final class CharacterEventList
{
    /**
     * This event occurs when a character is traveling
     */
    const TRAVEL = 'character.travel';

    /**
     * This event occurs when a character buys an Item on a Shop
     */
    const BUY = 'character.buy';

    /**
     * This event occurs when a character sells an Item to a Shop
     */
    const SELL = 'character.sell';

    /**
     * This event occurs when a characters rests
     */
    const REST = 'character.rest';
}
