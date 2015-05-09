<?php

namespace Game\GameBundle\Controller;

use Game\CharacterBundle\Manager\CharacterManager;
use Game\GameBundle\Manager\GameManager;
use Game\UserBundle\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        $charId = $this->getUserManager()->getCharacterId();
        $game = $this->getGameManager()->getFromCharacter($charId);

        return array(
            'game' => $game
        );
    }

    /**
     * @Route("/", name="game.status.detail")
     * @Template()
     */
    public function detailAction()
    {
        $char = $this->getUserManager()->getCharacter();
        $game = $char->getGame();
        return array(
            'game' => $game,
            'char' => $char,
        );
    }

    /**
     * @return CharacterManager
     */
    protected function getCharacterManager()
    {
        return $this->get('character.character_manager');
    }

    /**
     * @return UserManager;
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }

    /**
     * @return GameManager
     */
    private function getGameManager()
    {
        return $this->get('game.game_manager');
    }
}
