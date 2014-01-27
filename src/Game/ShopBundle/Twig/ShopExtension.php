<?php

namespace Game\ShopBundle\Twig;

use Game\ShopBundle\Manager\ShopManager;

class ShopExtension extends \Twig_Extension
{
    /** @var ShopManager */
    protected $shopManager;

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('calculateSellPrice', array($this, 'calculateSellPrice')),
            new \Twig_SimpleFunction('calculateBuyPrice', array($this, 'calculateBuyPrice')),
        );
    }

    /**
     * @param $shop
     * @param $item
     * @return int
     */
    public function calculateSellPrice($shop, $item)
    {
        return $this->shopManager->calculateSellPrice($shop, $item);
    }

    /**
     * @param $shop
     * @param $item
     * @return int
     */
    public function calculateBuyPrice($shop, $item)
    {
        return $this->shopManager->calculateBuyPrice($shop, $item);
    }

    /**
     * @param $shopManager
     */
    public function setShopManager($shopManager)
    {
        $this->shopManager = $shopManager;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'shop_extension';
    }
}