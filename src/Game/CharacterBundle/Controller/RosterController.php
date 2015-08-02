<?php

namespace Game\CharacterBundle\Controller;

use Game\CharacterBundle\Manager\CharacterClassManager;
use Game\CharacterBundle\Manager\PortraitManager;
use Game\CharacterBundle\Manager\RosterManager;
use Game\GameBundle\Manager\GameManager;
use Game\MapBundle\Manager\PoiManager;
use Game\MonsterBundle\Manager\RaceManager;
use Game\NotificationBundle\Manager\NotificationManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Game\UserBundle\Manager\UserManager;
use Game\CharacterBundle\Entity\Character;
use Symfony\Component\HttpFoundation\Request;

class RosterController extends Controller
{
    /**
     * @Route("/index", name="character.roster.index")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->getUserManager()->getCurrentUser();

        $this->getUserManager()->unselectCharacter();

        return array(
            'user' => $user
        );
    }

    /**
     * @Route("/select/{id}", name="character.roster.select", requirements={"id" = "\d+"})
     * @Template()
     * @ParamConverter("char", class="CharacterBundle:Character")
     */
    public function selectAction(Character $char)
    {
        $this->getUserManager()->selectCharacter($char);
        $this->getUserManager()->flush();
        return $this->redirect($this->generateUrl('map.view'));
    }

    /**
     * @Route("/create", name="character.roster.create")
     * @Template()
     */
    public function createAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $name       = $request->get('name');
            $race       = $this->getRaceManager()->findRace($request->get('race'));
            $class      = $this->getCharacterClassManager()->findClass($request->get('class'));
            $portrait   = $request->get('portrait');
            //$game = $this->getGameManager()->findOpenGameToJoin();
            $game = $this->getGameManager()->findOneById($request->get('game'));
            $poi        = $this->getPoiManager()->getStartingPoi($game);
            $user = $this->getUserManager()->getCurrentUser();
            $character = $this->getRosterManager()->createCharacter(
                $name,
                $race,
                $class,
                $user,
                $poi,
                $portrait,
                $game
            );
            $this->getRosterManager()->flush();

            //notification
            $this->getNotificationManager()->sendToCharacter(
                $game,
                $user,
                'Welcome adventurer!',
                'Make sure you read the tutorial and bla bla bla.'
            );
            $this->getNotificationManager()->flush();

            return $this->selectAction($character);
        }

        return array(
            'races'     => $this->getRaceManager()->getSelectableRaces(),
            'classes'   => $this->getCharacterClassManager()->getSelectableClasses(),
            'portraits' => $this->getPortraitManager()->getAll(),
            'games'     => $this->getGameManager()->getAvailableGamesWithPlayers()
        );
    }

    /**
     * @return UserManager;
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }

    /**
     * @return RosterManager
     */
    private function getRosterManager()
    {
        return $this->get('character.roster_manager');
    }

    /**
     * @return RaceManager
     */
    private function getRaceManager()
    {
        return $this->get('monster.race_manager');
    }

    /**
     * @return CharacterClassManager
     */
    private function getCharacterClassManager()
    {
        return $this->get('character.characterclass_manager');
    }

    /**
     * @return PoiManager
     */
    private function getPoiManager()
    {
        return $this->get('map.poi_manager');
    }

    /**
     * @return PortraitManager
     */
    private function getPortraitManager()
    {
        return $this->get('character.portrait_manager');
    }

    /**
     * @return GameManager
     */
    private function getGameManager()
    {
        return $this->get('game.game_manager');
    }

    /**
     * @return NotificationManager
     */
    private function getNotificationManager()
    {
        return $this->get('notification.notification_manager');
    }
}
