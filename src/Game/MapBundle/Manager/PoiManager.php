<?php

namespace Game\MapBundle\Manager;

use Game\CoreBundle\Manager\CoreManager;
use Game\MapBundle\Entity\Poi;

class PoiManager extends CoreManager
{
    /**
     * @return CharacterRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @return Poi
     */
    public function getStartingPoi()
    {
        return $this->getRepository()->findOneBy(array('startPoint'=>true));
    }
} 