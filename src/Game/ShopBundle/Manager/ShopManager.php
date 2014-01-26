<?php

namespace Game\ShopBundle\Manager;

use Game\ItemBundle\Entity\Repository\ShopRepository;
use Game\CoreBundle\Manager\CoreManager;

class ShopManager extends CoreManager
{
    /**
     * @return ItemRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }
}