<?php

namespace Game\ShopBundle\Twig;

use Game\ShopBundle\Manager\ShopManager;

class ShopExtension extends \Twig_Extension
{
    /** @var ShopManager */
    protected $shopManager;

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('calculateSellPrice', array($this, 'calculateSellPrice')),
        );
    }

    public function calculateSellPrice($shop, $item)
    {
        return $this->shopManager->calculateSellPrice($shop, $item);
    }

    public function setShopManager($shopManager)
    {
        $this->shopManager = $shopManager;
    }

    public function getName()
    {
        return 'shop_extension';
    }
}