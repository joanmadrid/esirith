<?php

namespace Game\ShopBundle\Manager;

use Game\CharacterBundle\Entity\CharacterItem;
use Game\ItemBundle\Entity\Repository\ShopRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\ItemBundle\Entity\Item;
use Game\ShopBundle\Entity\Shop;
use Game\ShopBundle\Entity\ShopItem;
use Game\CharacterBundle\Entity\Character;
use Game\ShopBundle\Model\Buyout;
use Game\CharacterBundle\CharacterEventList;
use Game\CharacterBundle\Event\CharacterEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ShopManager extends CoreManager
{
    /** @var EventDispatcher */
    protected $eventDispatcher;

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

    /**
     * Calcula el precio de compra, decrementado por el % de la tienda
     *
     * @param Shop $shop
     * @param Item $item
     * @return int
     */
    public function calculateBuyPrice(Shop $shop, Item $item)
    {
        return round($item->getValue() - ($item->getValue()*($shop->getBuyDecrement() / 100)));
    }

    /**
     * @param EventDispatcher $eventDispatcher
     */
    public function setEventDispatcher($eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }


    /**
     * Ejecuta la acción de una compra si es posible
     *
     * @param Character $char
     * @param ShopItem $shopItem
     * @return Buyout
     */
    public function buy(Character $char, ShopItem $shopItem)
    {
        $itemSellPrice = $this->calculateSellPrice($shopItem->getShop(), $shopItem->getItem());
        $characterGold = $char->getGold();
        $buyout = new Buyout();

        if ($characterGold >= $itemSellPrice) {
            $buyout->setSuccess(true);
            $buyout->setGoldLeft($characterGold - $itemSellPrice);

            /** @var CharacterEvent $characterEvent */
            $characterEvent = new CharacterEvent($char);
            $characterEvent->setBuyout($buyout);
            $this->eventDispatcher->dispatch(CharacterEventList::BUY, $characterEvent);

            $this->giveItem($shopItem, $char);
        } else {
            $buyout->setSuccess(false);
        }

        return $buyout;
    }

    /**
     * Vende un objeto a una tienda
     *
     * @param CharacterItem $charItem
     * @param Shop $shop
     * @return Buyout
     */
    public function sell(CharacterItem $charItem, Shop $shop)
    {
        $char = $charItem->getCharacter();
        $itemBuyPrice = $this->calculateBuyPrice($shop, $charItem->getItem());
        $characterGold = $char->getGold();
        $buyout = new Buyout();

        $buyout->setSuccess(true);
        $buyout->setGoldLeft($characterGold + $itemBuyPrice);

        /** @var CharacterEvent $characterEvent */
        $characterEvent = new CharacterEvent($char);
        $characterEvent->setBuyout($buyout);
        $this->eventDispatcher->dispatch(CharacterEventList::SELL, $characterEvent);

        $this->takeItem($charItem);

        return $buyout;
    }

    /**
     * Da un objeto a un personaje
     *
     * @param ShopItem $shopItem
     * @param Character $char
     */
    private function giveItem(ShopItem $shopItem, Character $char)
    {
        $charItem = new CharacterItem();
        $charItem->setItem($shopItem->getItem());
        $charItem->setCharacter($char);
        $this->persist($charItem);
    }

    /**
     * Quita un objeto a un personaje
     *
     * @param CharacterItem $charItem
     */
    private function takeItem(CharacterItem $charItem)
    {
        $this->remove($charItem);
        //$this->persist($charItem);
    }
}