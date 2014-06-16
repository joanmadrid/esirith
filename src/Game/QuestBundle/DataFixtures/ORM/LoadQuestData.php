<?php
namespace Game\QuestBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Game\QuestBundle\Entity\Quest;

class LoadQuestData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $quests = array(
            array('Goblin menace', mt_rand(10, 50), 1, 'goblin_menace.jpg', 'Lorem Ipsum'),
            array('Strike at Goblin dungeon', mt_rand(20, 100), 2, 'goblin_dungeon.jpg', 'Lorem Ipsum'),
            array('Raiding the Kobold dungeon',  mt_rand(30, 150), 3, 'kobold_dungeon.jpg', 'Lorem Ipsum'),
            array('Pirates and marauders in the city',  mt_rand(40, 200), 4, 'pirates_marauders.jpg', 'Lorem Ipsum'),
            array('Something is killing in the streets',  mt_rand(50, 300), 5, 'hidden_killer.jpg', 'Lorem Ipsum'),
            array('Scarecrows',  mt_rand(60, 400), 6, 'reanimated_scarecrows.jpg', 'Lorem Ipsum'),
            array('The attack of the swamp',  mt_rand(70, 500), 7, 'swamp_monsters.jpg', 'Lorem Ipsum'),
            array('The White Wyrm',  mt_rand(80, 600), 8, 'white_wyrm.jpg', 'Lorem Ipsum'),
        );

        foreach ($quests as $questData) {
            $quest = new Quest();
            $quest
                ->setName($questData[0])
                ->setGold($questData[1])
                ->setLevel($questData[2])
                ->setImage($questData[3])
                ->setDescription($questData[4]);
            $manager->persist($quest);
        }
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 9;
    }
}
