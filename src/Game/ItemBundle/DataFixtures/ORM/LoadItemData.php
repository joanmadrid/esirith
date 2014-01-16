<?php
namespace Game\ItemBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Game\ItemBundle\Entity\Weapon;

class LoadItemData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $weapons = array();
        $weapons[] = array('Dagger', 1);
        $weapons[] = array('Short sword', 2);
        $weapons[] = array('Long sword', 3);
        $weapons[] = array('Axe', 3);

        $out = array();
        foreach ($weapons as $weapon) {
            $aux = new Weapon();
            $aux->setName($weapon[0]);
            $aux->setDamage($weapon[1]);
            $manager->persist($aux);
            $out[] = $aux;
        }

        $manager->flush();

        $this->addReference('weapon-long-sword', $out[2]);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
