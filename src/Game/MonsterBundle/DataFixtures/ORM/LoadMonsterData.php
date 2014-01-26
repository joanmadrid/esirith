<?php
namespace Game\MonsterBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Game\MonsterBundle\Entity\Monster;

class LoadMonsterData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // name, internal, race, hp, damage, defense, fue, des
        $monsterList   = array();
        $monsterList[] = array('Peter', 'boy_1', 'human', 10, 2, 13, 13, 10);
        $monsterList[] = array('Joshé', 'boy_1', 'elf', 15, 1, 8, 10, 13);
        $monsterList[] = array('Ann', 'girl_1', 'dwarf', 7, 2, 20, 15, 8);
        $monsterList[] = array('Sareha', 'girl_2', 'gnome', 10, 3, 10, 8, 15);

        $out = array();
        foreach ($monsterList as $monster) {
            $aux = new Monster();

            $aux
                ->setName($monster[0])
                ->setInternalName($monster[1])
                ->setRace($this->getReference('race-' . $monster[2]))
                ->setHp($monster[3])
                ->setCurrentHp($monster[3])
                ->setDamage($monster[4])
                ->setDefense($monster[5])
                ->setFue($monster[6])
                ->setDes($monster[7])
                ->setLevel(1);

            $manager->persist($aux);
            $out[] = $aux;
        }

        $manager->flush();

        $this->addReference('monster-human-boy', $out[0]);
        $this->addReference('monster-elf-boy', $out[1]);
        $this->addReference('monster-dwarf-girl', $out[2]);
        $this->addReference('monster-gnome-girl', $out[3]);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5;
    }
}
