<?php

namespace Game\CompanionBundle\Controller;

use Game\CompanionBundle\Manager\CompanionManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    /**
     * @return CompanionManager
     */
    private function getCompanionManager()
    {
        return $this->get('companion.companion_manager');
    }
}
