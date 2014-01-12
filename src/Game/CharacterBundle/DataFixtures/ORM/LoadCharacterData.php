<?php
namespace Game\CharacterBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Game\CharacterBundle\Entity\Character;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $char = new Character();
        $char->setName('Conan');
        $manager->persist($char);

        $manager->flush();
    }
}
