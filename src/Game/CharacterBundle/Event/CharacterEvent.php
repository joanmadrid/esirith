<?php

namespace Game\CharacterBundle\Event;

use Game\CharacterBundle\Entity\Character;
use Game\CharacterBundle\Model\CharacterRestore;
use Game\ShopBundle\Model\Buyout;
use Symfony\Component\EventDispatcher\Event;
use Game\MonsterBundle\Entity\Monster;

class CharacterEvent extends Event
{
    /** @var  Character $character */
    protected $character;

    /** @var  CharacterRestore $characterRestore */
    protected $characterRestore;

    /** @var Buyout */
    protected $buyout;

    /** @var integer */
    protected $restType;

    /** @var Monster */
    protected $monster;

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

    /**
     * @param \Game\ShopBundle\Model\Buyout $buyout
     */
    public function setBuyout($buyout)
    {
        $this->buyout = $buyout;
    }

    /**
     * @return \Game\ShopBundle\Model\Buyout
     */
    public function getBuyout()
    {
        return $this->buyout;
    }

    /**
     * @param int $restType
     */
    public function setRestType($restType)
    {
        $this->restType = $restType;
    }

    /**
     * @return int
     */
    public function getRestType()
    {
        return $this->restType;
    }

    /**
     * @param \Game\MonsterBundle\Entity\Monster $monster
     */
    public function setMonster($monster)
    {
        $this->monster = $monster;
    }

    /**
     * @return \Game\MonsterBundle\Entity\Monster
     */
    public function getMonster()
    {
        return $this->monster;
    }
}
