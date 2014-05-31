<?php
namespace Game\ItemBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Game\ItemBundle\Entity\Armor;
use Game\ItemBundle\Entity\Potion;
use Game\ItemBundle\Entity\Weapon;

class LoadItemData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->loadWeapons($manager);
        $this->loadArmors($manager);
        $this->loadPotions($manager);
    }

    private function loadWeapons($manager)
    {
        $weapons = array();
        $weapons[] = array('Dagger', 1, 4, Weapon::WEAPON_DAMAGE_TYPE_SLASHING, 10, 2, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_ONE, 'dagger.png');
        $weapons[] = array('Short sword', 1, 6, Weapon::WEAPON_DAMAGE_TYPE_SLASHING, 10, 2, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_ONE, 'short_sword.png');
        $weapons[] = array('Long sword', 1, 8, Weapon::WEAPON_DAMAGE_TYPE_SLASHING, 10, 2, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_ONE, 'long_sword.png');
        $weapons[] = array('Handaxe', 1, 6, Weapon::WEAPON_DAMAGE_TYPE_SLASHING, 5, 3, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_ONE, 'handaxe.png');

        $weapons[] = array('Greatsword', 1, 10, Weapon::WEAPON_DAMAGE_TYPE_SLASHING, 10, 2, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_TWO, 'greatsword.png');
        $weapons[] = array('Heavy flail', 1, 10, Weapon::WEAPON_DAMAGE_TYPE_BLUDGEONING, 10, 2, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_TWO, 'heavy_flail.png');
        $weapons[] = array('Lance', 1, 8, Weapon::WEAPON_DAMAGE_TYPE_PIERCING, 5, 3, Weapon::WEAPON_TYPE_MELEE, Weapon::WEAPON_HANDS_TWO, 'lance.png');

        $weapons[] = array('Longbow', 1, 8, Weapon::WEAPON_DAMAGE_TYPE_PIERCING, 5, 3, Weapon::WEAPON_TYPE_RANGED, Weapon::WEAPON_HANDS_TWO, 'longbow.png');

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
            $aux->setImage($weapon[8]);
            $aux->setValue(rand(5, 20));
            $manager->persist($aux);
            $out[] = $aux;
        }

        $manager->flush();

        $this->addReference('weapon-dagger', $out[0]);
        $this->addReference('weapon-short-sword', $out[1]);
        $this->addReference('weapon-long-sword', $out[2]);
        $this->addReference('weapon-handaxe', $out[3]);
        $this->addReference('weapon-greatsword', $out[4]);
        $this->addReference('weapon-heavy-flail', $out[5]);
        $this->addReference('weapon-lance', $out[6]);
        $this->addReference('weapon-longbow', $out[7]);
    }

    private function loadArmors($manager)
    {
        $armors = array(
            array('Leather', 1, 10, 'leather.png'),
            array('Mail', 2, 50, 'mail.png'),
            array('Plated', 5, 250, 'plated.png'),
            array('Full plated', 10, 500, 'full.png'),
        );

        foreach ($armors as $armorInfo) {
            $armor = new Armor();
            $armor->setName($armorInfo[0]);
            $armor->setDefense($armorInfo[1]);
            $armor->setValue($armorInfo[2]);
            $armor->setImage($armorInfo[3]);
            $manager->persist($armor);
            $this->addReference('armor-'.$this->transformToReference($armorInfo[0]), $armor);
        }

        $manager->flush();
    }

    private function loadPotions($manager)
    {
        $potions = array(
            array('Potion of health', Potion::POTION_TYPE_HEAL, 100, 'red.png')
        );

        foreach ($potions as $potionInfo) {
            $potion = new Potion();
            $potion->setName($potionInfo[0]);
            $potion->setPotionType($potionInfo[1]);
            $potion->setValue($potionInfo[2]);
            $potion->setImage($potionInfo[3]);
            $manager->persist($potion);
            $this->addReference($this->transformToReference($potionInfo[0]), $potion);
        }
        $manager->flush();
    }

    private function transformToReference($name)
    {
        return strtolower(str_replace(" ", "-", $name));
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
