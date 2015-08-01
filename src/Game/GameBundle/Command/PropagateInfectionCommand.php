<?php

namespace Game\GameBundle\Command;

use Game\GameBundle\Entity\Game;
use Game\GameBundle\Manager\BossManager;
use Game\GameBundle\Manager\GameManager;
use Game\GameBundle\Manager\RaidManager;
use Game\NotificationBundle\Manager\NotificationManager;
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
        /** @var RaidManager $raidManager */
        $raidManager = $this->getContainer()->get('game.raid_manager');
        /** @var NotificationManager $notificationManager */
        $notificationManager = $this->getContainer()->get('notification.notification_manager');

        $games = $gameManager->getInProgressWithBoss();
        foreach ($games as $game) {
            /** @var Game $game */
            $output->writeln('= Game: '.$game->getName().' =');
            $boss = $game->getBoss();
            $raids = $raidManager->getActiveRaids($boss);
            if (count($raids) > 0) {
                $output->writeln('Resolving raid');
                $result = $bossManager->resolveRaid($boss, $raids);
                $output->writeln('raid result: '.($result?'won':'lost'));

                //notification
                $notificationManager->sendToGame(
                    $game,
                    'A group of brave adventurers attacked the evil den',
                    (
                        $result
                        ?
                        'And they managed to keep ['.$boss->getName().'] and stop the evil expansion'
                        :
                        'But they got defeated by ['.$boss->getName().']'
                    )
                );
            } else {
                $prop = $bossManager->propagateInfection($boss);
                if ($prop) {
                    $output->writeln('Propagating');
                    $bossManager->attackInfectedPois($boss);
                    $output->writeln('Attacking infected pois');

                    //notification
                    $notificationManager->sendToGame(
                        $game,
                        'The evil is awakened',
                        'The evil ['.$boss->getName().'] woke up and attacked Esirith'
                    );
                } else {
                    //notification
                    $notificationManager->sendToGame(
                        $game,
                        'Game end',
                        'The evil ['.$boss->getName().'] spread the evil on the entire Esirith lands'
                    );
                    $gameManager->endGame($game, Game::LOST_REASON_PROPAGATE);
                    $output->writeln('Game lost: couldn\'t propagate');
                }
            }
        }
        $notificationManager->flush();
        $bossManager->flush();
        $gameManager->flush();
    }
}
