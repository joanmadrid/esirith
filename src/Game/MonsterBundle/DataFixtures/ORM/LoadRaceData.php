<?php
namespace Game\MonsterBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Game\MonsterBundle\Entity\Race;


class LoadRaceData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $raceList   = array();
        $raceList[] = array('Human', 'human', true);
        $raceList[] = array('Dwarf', 'dwarf', true);
        $raceList[] = array('Elf',   'elf',   true);
        $raceList[] = array('Gnome', 'gnome', true);
        $raceList[] = array('Orc', 'orc', false);
        $raceList[] = array('Undead', 'undead', false);

        $outList = array();
        foreach ($raceList as $race) {
            $aux = new Race();

            $aux
                ->setName($race[0])
                ->setInternalName($race[1])
                ->setSelectable($race[2]);

            $manager->persist($aux);
            $outList[] = $aux;

        }

        foreach ($outList as $out) {
            $this->addReference('race-'.$out->getInternalName(), $out);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5;
    }
}
