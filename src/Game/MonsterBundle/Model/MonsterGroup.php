<?php

namespace Game\MonsterBundle\Model;

use Game\MonsterBundle\Entity\Monster;

class MonsterGroup implements \Iterator
{
    /** @var array */
    protected $items = array();

    public function addMonster(Monster $monster, $number = 1)
    {
        //gamedo: si se añade uno repetido, buscarlo y ponerlo donde toca?
        $this->items[] = new MonsterGroupItem($monster, $number);
        return $this;
    }

    /**
     * @return array
     */
    public function getMonsters()
    {
        return $this->items;
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        $var = current($this->items);
        return $var;
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $var = next($this->items);
        return $var;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        $var = key($this->items);
        return $var;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        $key = key($this->items);
        $var = ($key !== NULL && $key !== FALSE);
        return $var;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        reset($this->items);
    }
}

class MonsterGroupItem
{
    /** @var Monster */
    protected $monster;

    /** @var integer */
    protected $number;

    function __construct(Monster $monster, $number = 1)
    {
        $this->monster = $monster;
        $this->number = $number;
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

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }


}