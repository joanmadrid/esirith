<?php

namespace Game\MapBundle\Manager;


use Doctrine\Common\Collections\Collection;
use Game\CoreBundle\Manager\CoreManager;
use Game\MapBundle\Entity\Repository\MapRepository;

class MapManager extends CoreManager
{
    /**
     * @return Collection
     */
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * @return MapRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }
}
