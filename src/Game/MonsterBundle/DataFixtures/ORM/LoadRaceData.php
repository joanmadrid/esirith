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
        $raceList[] = array('Dwarf', 'dwarf', false);
        $raceList[] = array('Elf',   'elf',   true);
        $raceList[] = array('Gnome', 'gnome', false);

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

        foreach ($outList as $key => $out) {
            $this->addReference('race-' . $raceList[$key][1], $out);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4;
    }
}
