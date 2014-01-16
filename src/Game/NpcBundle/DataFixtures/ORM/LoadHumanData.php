<?php
namespace Game\NpcBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Game\NpcBundle\Entity\Human;

class LoadHumanData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $npcList = array();
        $npcList[] = array('Peter', 'boy_1', 10);
        $npcList[] = array('Joshé', 'boy_1', 15);
        $npcList[] = array('Ann', 'girl_1', 7);
        $npcList[] = array('Sareha', 'girl_2', 10);

        $out = array();
        foreach ($npcList as $npc) {
            $aux = new Human();

            $aux
                ->setName($npc[0])
                ->setInternalName($npc[1])
                ->setHp($npc[2]);

            $manager->persist($aux);
            $out[] = $aux;
        }

        $manager->flush();

        $this->addReference('npc_human_boy', $out[1]);
        $this->addReference('npc_human_girl', $out[3]);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4;
    }
}
