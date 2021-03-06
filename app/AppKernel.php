<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Game\CharacterBundle\CharacterBundle(),
            new Game\CoreBundle\CoreBundle(),
            new Game\ItemBundle\ItemBundle(),
            new Game\UIBundle\UIBundle(),
            new Game\MapBundle\MapBundle(),
            new Game\ShopBundle\ShopBundle(),
            new Game\MonsterBundle\MonsterBundle(),
            new Game\BattleBundle\BattleBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Game\UserBundle\UserBundle(),
            new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),
            new Game\CompanionBundle\CompanionBundle(),
            //new Liip\ImagineBundle\LiipImagineBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new Game\QuestBundle\QuestBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new Game\GameBundle\GameBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new FOS\CommentBundle\FOSCommentBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            new Game\CommentBundle\CommentBundle(),
            new Game\NotificationBundle\NotificationBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }
}
