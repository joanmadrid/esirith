<?php

namespace Game\CompanionBundle\Model;


class CompanionBuffs
{
    private $types = array();

    private $abilities = array();

    public function addType($type)
    {
        array_push($this->types, $type);
        array_unique($this->types);
    }

    public function addAbility($ability)
    {
        array_push($this->abilities, $ability);
        array_unique($this->abilities);
    }

    public function hasType($type)
    {
        return (in_array($type, $this->types));
    }

    public function hasAbility($ability)
    {
        return (in_array($ability, $this->abilities));
    }
}
