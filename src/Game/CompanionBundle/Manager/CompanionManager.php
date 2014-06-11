<?php

namespace Game\CompanionBundle\Manager;

use Game\CompanionBundle\Entity\Repository\CompanionRepository;
use Game\CoreBundle\Manager\CoreManager;

class CompanionManager extends CoreManager
{
    /**
     * @return CompanionRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }
}
