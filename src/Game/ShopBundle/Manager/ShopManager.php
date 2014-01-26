<?php

namespace Game\ShopBundle\Manager;

use Game\ItemBundle\Entity\Repository\ShopRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\ItemBundle\Entity\Item;
use Game\ShopBundle\Entity\Shop;

class ShopManager extends CoreManager
{
    /**
     * @return ItemRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * Calcula el precio de venta, incrementado por el % de la tienda
     *
     * @param Shop $shop
     * @param Item $item
     * @return int
     */
    public function calculateSellPrice(Shop $shop, Item $item)
    {
        return round($item->getValue() + ($item->getValue()*($shop->getSellIncrement() / 100)));
    }
}