<?php

namespace Game\ItemBundle\Manager;


use Game\CoreBundle\Manager\CoreManager;
use Game\ItemBundle\Entity\Repository\ItemRepository;

class ItemManager extends CoreManager
{
    /**
     * @return ItemRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getItemByName($name)
    {
        return $this->getRepository()->findOneByName($name);
    }
}
