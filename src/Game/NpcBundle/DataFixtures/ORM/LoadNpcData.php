<?php
namespace Game\NpcBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Game\NpcBundle\Entity\Npc;

class LoadNpcData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $npcList   = array();
        $npcList[] = array('Peter',  'boy_1',  'human', 10, 2);
        $npcList[] = array('Joshé',  'boy_1',  'elf',   15, 1);
        $npcList[] = array('Ann',    'girl_1', 'dwarf', 7,  2);
        $npcList[] = array('Sareha', 'girl_2', 'gnome', 10, 3);

        $out = array();
        foreach ($npcList as $npc) {
            $aux = new Npc();

            $aux
                ->setName($npc[0])
                ->setInternalName($npc[1])
                ->setRace($this->getReference('race-' . $npc[2]))
                ->setHp($npc[3])
                ->setCurrentHp($npc[3])
                ->setDamage($npc[4]);

            $manager->persist($aux);
            $out[] = $aux;
        }

        $manager->flush();

        $this->addReference('npc-human-boy', $out[1]);
        $this->addReference('npc-human-girl', $out[3]);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5;
    }
}
