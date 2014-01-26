<?php

namespace Game\CharacterBundle\Event;

use Game\CharacterBundle\Entity\Character;
use Game\CharacterBundle\Model\CharacterRestore;
use Symfony\Component\EventDispatcher\Event;

class CharacterEvent extends Event
{
    /** @var  Character $character */
    protected $character;

    /** @var  CharacterRestore $characterRestore */
    protected $characterRestore;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    /**
     * @return Character
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @param CharacterRestore $characterRestore
     *
     * @return $this
     */
    public function setCharacterRestore(CharacterRestore $characterRestore)
    {
        $this->characterRestore = $characterRestore;

        return $this;
    }

    /**
     * @return CharacterRestore
     */
    public function getCharacterRestore()
    {
        return $this->characterRestore;
    }
}
