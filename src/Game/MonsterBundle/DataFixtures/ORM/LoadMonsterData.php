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
        // name, internal, image, race, hp, damage, defense, fue, des
        $monsterList   = array();
        $monsterList[] = array('Orc', 'orc_1', 'orc.png', 'orc', 10, 3, 1, 15, 8);
        $monsterList[] = array('Shadow', 'shadow_1', 'shadow.png', 'undead', 20, 4, 1, 10, 10);
        $monsterList[] = array('Lich', 'lich_1', 'lich.png', 'undead', 30, 6, 5, 10, 10);

        $out = array();
        foreach ($monsterList as $monster) {
            $aux = new Monster();

            $aux
                ->setName($monster[0])
                ->setInternalName($monster[1])
                ->setImage($monster[2])
                ->setRace($this->getReference('race-'.$monster[3]))
                ->setHp($monster[4])
                ->setCurrentHp($monster[4])
                ->setDamage($monster[5])
                ->setDefense($monster[6])
                ->setStr($monster[7])
                ->setDex($monster[8])
                ->setLevel(1);

            $manager->persist($aux);
            $out[] = $aux;
        }

        $manager->flush();

        foreach ($out as $val) {
            $this->addReference('monster-'.$val->getInternalName(), $val);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 6;
    }
}
