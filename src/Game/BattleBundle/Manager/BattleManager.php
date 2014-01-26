<?php

namespace Game\BattleBundle\Manager;


use Game\CoreBundle\Manager\CoreManager;

class BattleManager extends CoreManager
{

    /**
     * @return BattleRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }
}
