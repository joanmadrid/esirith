<?php
namespace Game\MonsterBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


use Game\MonsterBundle\Entity\Spawn;

class LoadSpawnData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $monsterList  = array('monster-orc_1', 'monster-shadow_1', 'monster-lich_1');
        $poiCount = 6; //Hard-code del numero de Poi's sin contar el inicial

        $insertKeys = array();

        for ($i = 0; $i < 15; $i++) {
            $monster = $this->getReference($monsterList[mt_rand(0, count($monsterList)-1)]);
            $poi = $this->getReference('poi#' . mt_rand(0, $poiCount));
            $key = $monster->getId() . ' - ' . $poi->getId();

            if (in_array($key, $insertKeys)) {
                continue;
            }

            $insertKeys[] = $key;

            $aux = new Spawn();
            $aux
                ->setMonster($monster)
                ->setPoi($poi)
                ->setRate(mt_rand(0, 75));

            $manager->persist($aux);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 7;
    }
}
