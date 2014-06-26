<?php
namespace Game\GameBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Game\GameBundle\Entity\Boss;
use Game\GameBundle\Entity\Game;

class LoadGameData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $game = new Game();
        $game->setName('Test game');
        $game->setStart(new \DateTime());

        $boss = new Boss();
        $boss->setName('Kyrien');
        $boss->setImage('boss_s1.jpg');
        $boss->setCurrentHp(1000);
        $boss->setMaxHP(1000);
        $boss->setGame($game);

        $game->setBoss($boss);

        $manager->persist($boss);
        $manager->persist($game);

        $manager->flush();

        $this->addReference('game-test', $game);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
