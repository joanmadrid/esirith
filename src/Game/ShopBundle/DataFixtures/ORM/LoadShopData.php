<?php
namespace Game\ShopBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Game\ShopBundle\Entity\Shop;
use Game\ShopBundle\Entity\ShopItem;

class LoadShopData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $shop = new Shop();
        $shop->setName("Blacksmith");
        $shop->setBuyDecrement(10);
        $shop->setSellIncrement(15);
        $shop->setPoi($this->getReference('poi-city'));
        $manager->persist($shop);

        $items = array('weapon-dagger', 'weapon-short-sword', 'weapon-long-sword', 'weapon-handaxe',
            'weapon-greatsword', 'weapon-heavy-flail', 'weapon-lance', 'weapon-longbow');

        foreach ($items as $itemRef) {
            $item = new ShopItem();
            $item->setShop($shop);
            $item->setItem($this->getReference($itemRef));
            $manager->persist($item);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4;
    }
}
