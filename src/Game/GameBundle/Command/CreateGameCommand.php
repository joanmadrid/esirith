<?php

namespace Game\GameBundle\Command;

use Game\GameBundle\Manager\GameCreatorManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateGameCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('game:create')
            ->setDescription('Creates a new game')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var GameCreatorManager $gameCreatorManager */
        $gameCreatorManager = $this->getContainer()->get('game.gamecreator_manager');
        $gameCreatorManager->createGame();
    }
}
