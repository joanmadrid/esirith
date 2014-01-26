<?php

namespace Game\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Game\ShopBundle\Entity\Shop;

class DefaultController extends Controller
{
    /**
     * @Route("/{id}", name="shop.view", requirements={"id" = "\d+"})
     * @Template()
     * @ParamConverter("map", class="GameShopBundle:Shop")
     */
    public function viewAction(Shop $shop)
    {
        return array(
            'shop' => $shop
        );
    }
}
