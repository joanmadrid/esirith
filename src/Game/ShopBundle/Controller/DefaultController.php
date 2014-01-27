<?php

namespace Game\ShopBundle\Controller;

use Game\CharacterBundle\Manager\CharacterItemManager;
use Game\ShopBundle\Manager\ShopManager;
use Game\ShopBundle\Model\Buyout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Game\ShopBundle\Entity\Shop;
use Game\ShopBundle\Entity\ShopItem;
use Game\CharacterBundle\Entity\CharacterItem;

class DefaultController extends Controller
{
    /**
     * @Route("/{id}", name="shop.view", requirements={"id" = "\d+"})
     * @Template()
     * @ParamConverter("shop", class="ShopBundle:Shop")
     */
    public function viewAction(Shop $shop)
    {
        // gamedo: coger personaje de sesion
        $char = $this->getCharacterManager()->findByNameWithPoi('Conan');

        $items = $this->getCharacterItemManager()->getCharacterItems($char);

        return array(
            'shop'  => $shop,
            'items' => $items,
            'char'  => $char
        );
    }

    /**
     * @Route("/buy/{id}", name="shop.buy", requirements={"id" = "\d+"})
     * @ParamConverter("shopItem", class="ShopBundle:ShopItem")
     */
    public function buyAction(ShopItem $shopItem)
    {
        // gamedo: coger personaje de sesion
        $char = $this->getCharacterManager()->findByNameWithPoi('Conan');

        /** @var Buyout $buyout */
        $buyout = $this->getShopManager()->buy($char, $shopItem);

        // gamedo: mirar que este actualmente en el mismo POI que la tienda
        if ($buyout->getSuccess()) {
            $this->get('session')->getFlashBag()->add('success',
                'Buyout successful. You have '.$buyout->getGoldLeft().' gold left'
            );
            $this->getShopManager()->flush();
        } else {
            $this->get('session')->getFlashBag()->add('error',
                "You don't have enough money"
            );
        }

        return $this->redirect($this->generateUrl('shop.view', array('id'=>$shopItem->getShop()->getId())));
    }

    /**
     * @Route("/sell/{item}/to/{shop}", name="shop.sell", requirements={"item" = "\d+", "shop" = "\d+"})
     * @ParamConverter("characterItem", class="CharacterBundle:CharacterItem", options={"id" = "item"})
     * @ParamConverter("shop", class="ShopBundle:Shop", options={"id" = "shop"})
     */
    public function sellAction(CharacterItem $characterItem, Shop $shop)
    {
        // gamedo: coger personaje de sesion
        $char = $this->getCharacterManager()->findByNameWithPoi('Conan');

        /** @var Buyout $buyout */
        $buyout = $this->getShopManager()->sell($characterItem, $shop);

        // gamedo: mirar que este actualmente en el mismo POI que la tienda
        if ($buyout->getSuccess()) {
            $this->get('session')->getFlashBag()->add('success',
                'Selling successful. You have '.$buyout->getGoldLeft().' gold now'
            );
            $this->getShopManager()->flush();
        } else {
            $this->get('session')->getFlashBag()->add('error',
                "You can't sell this item"
            );
        }

        return $this->redirect($this->generateUrl('shop.view', array('id'=>$shop->getId())));
    }

    /**
     * @return ShopManager
     */
    private function getShopManager()
    {
        return $this->get('shop.shop_manager');
    }

    /**
     * @return CharacterManager
     */
    protected function getCharacterManager()
    {
        return $this->get('character.character_manager');
    }

    /**
     * @return CharacterItemManager
     */
    protected function getCharacterItemManager()
    {
        return $this->get('character.characteritem_manager');
    }
}
