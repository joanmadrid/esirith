<?php
namespace Game\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Game\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $users = array(
            array('joan', 'joanmadrid@gmail.com', '123123'),
            array('jorge', 'jorgemoralezgonzalez@gmail.com', '123123'),
        );

        $saved = array();
        foreach ($users as $user) {
            $userManager = $this->container->get('fos_user.user_manager');
            /** @var User $aux */
            $aux = $userManager->createUser();
            $aux->setUsername($user[0]);
            $aux->setEmail($user[1]);
            $aux->setPlainPassword($user[2]);
            $aux->setEnabled(true);
            $userManager->updateUser($aux);
            $manager->persist($aux);
            $saved[] = $aux;
        }

        $manager->flush();

        foreach ($saved as $key => $item) {
            $this->addReference('user-'.$key, $saved[$key]);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
