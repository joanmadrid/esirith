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
        $weapons[] = array('Dagger', 1, 4, Weapon::WEAPON_DAMAGE_TYPE_SLASHING, 10, 2, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_ONE);
        $weapons[] = array('Short sword', 1, 6, Weapon::WEAPON_DAMAGE_TYPE_SLASHING, 10, 2, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_ONE);
        $weapons[] = array('Long sword', 1, 8, Weapon::WEAPON_DAMAGE_TYPE_SLASHING, 10, 2, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_ONE);
        $weapons[] = array('Handaxe', 1, 6, Weapon::WEAPON_DAMAGE_TYPE_SLASHING, 5, 3, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_ONE);

        $weapons[] = array('Greatsword', 1, 10, Weapon::WEAPON_DAMAGE_TYPE_SLASHING, 10, 2, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_TWO);
        $weapons[] = array('Heavy flail', 1, 10, Weapon::WEAPON_DAMAGE_TYPE_BLUDGEONING, 10, 2, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_TWO);
        $weapons[] = array('Lance', 1, 8, Weapon::WEAPON_DAMAGE_TYPE_PIERCING, 5, 3, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_TWO);

        $weapons[] = array('Longbow', 1, 8, Weapon::WEAPON_DAMAGE_TYPE_PIERCING, 5, 3, Weapon::WEAPON_TYPE_RANGED, Weapon::WEAPON_HANDS_TWO);

        $out = array();
        foreach ($weapons as $weapon) {
            $aux = new Weapon();
            $aux->setName($weapon[0]);
            $aux->setDamageDiceNumber($weapon[1]);
            $aux->setDamageDice($weapon[2]);
            $aux->setDamageType($weapon[3]);
            $aux->setCriticalChance($weapon[4]);
            $aux->setCriticalMultiplier($weapon[5]);
            $aux->setWeaponType($weapon[6]);
            $aux->setHands($weapon[7]);
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
