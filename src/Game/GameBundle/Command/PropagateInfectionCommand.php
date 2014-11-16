<?php

namespace Game\GameBundle\Command;

use Game\GameBundle\Manager\BossManager;
use Game\GameBundle\Manager\GameManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PropagateInfectionCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('game:boss:propagate-infection')
            ->setDescription('Expands the propagation and infects/attacks pois')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var BossManager $bossManager */
        $bossManager = $this->getContainer()->get('game.boss_manager');
        /** @var GameManager $gameManager */
        $gameManager = $this->getContainer()->get('game.game_manager');

        $games = $gameManager->getInProgressWithBoss();
        foreach ($games as $game) {
            $bossManager->propagateInfection($game->getBoss());
            $output->writeln('Propagating in game: '.$game->getName());
        }
        $bossManager->flush();
    }
}
