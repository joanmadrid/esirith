<?php
namespace Game\NpcBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


use Game\NpcBundle\Entity\Spawn;

class LoadSpawnData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $npcList  = array('npc-human-boy', 'npc-elf-boy', 'npc-dwarf-girl', 'npc-gnome-girl');
        $poiCount = 6; //Hard-code del numero de Poi's sin contar el inicial

        $insertKeys = array();

        for ($i = 0; $i < 15; $i++) {
            $npc = $this->getReference($npcList[mt_rand(0, count($npcList)-1)]);
            $poi = $this->getReference('poi#' . mt_rand(0, $poiCount));
            $key = $npc->getId() . ' - ' . $poi->getId();

            if (in_array($key, $insertKeys)) {
                continue;
            }

            $insertKeys[] = $key;

            $aux = new Spawn();
            $aux
                ->setNpc($npc)
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
        return 6;
    }
}
