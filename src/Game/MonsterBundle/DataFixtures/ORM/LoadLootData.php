<?php
namespace Game\MonsterBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Game\MonsterBundle\Entity\Monster;
use Game\MonsterBundle\Entity\LootTable;
use Game\MonsterBundle\Entity\LootItem;

class LoadLootData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $lootTables = array(
            array('Low', 0, 20,
                array(
                    array('weapon-dagger', 10),
                    array('weapon-short-sword', 10),
                    array('weapon-long-sword', 10),
                    array('weapon-handaxe', 10),
                    array('weapon-greatsword', 5),
                    array('weapon-heavy-flail', 5),
                    array('weapon-lance', 5),
                    array('weapon-longbow', 5)
                )
            )
        );

        foreach ($lootTables as $lootTable) {
            $lt = new LootTable();
            $lt->setName($lootTable[0]);
            $lt->setGoldMin($lootTable[1]);
            $lt->setGoldMax($lootTable[2]);

            $manager->persist($lt);

            foreach ($lootTable[3] as $lootItem) {
                $li = new LootItem();
                $li->setItem($this->getReference($lootItem[0]));
                $li->setChance($lootItem[1]);
                $li->setLootTable($lt);
                $manager->persist($li);
            }
            $this->addReference('loottable-'.strtolower($lootTable[0]), $lt);
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
