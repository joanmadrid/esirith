<?php

namespace Game\CharacterBundle\Model;

class CharacterRestore
{
    protected $hp;

    /**
     * @param mixed $hp
     *
     * @return $this
     */
    public function setHp($hp)
    {
        $this->hp = $hp;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHp()
    {
        return $this->hp;
    }
}
