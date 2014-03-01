<?php

namespace Game\CharacterBundle\Manager;

use Game\CharacterBundle\Entity\Character;
use Game\MonsterBundle\Entity\Monster;

class XPManager {

    public function calcKillXP(Character $char, Monster $monster)
    {
        return 1;
    }
}