<?php

namespace Game\MapBundle\Manager;

use Game\CoreBundle\Manager\CoreManager;
use Game\GameBundle\Entity\Game;
use Game\MapBundle\Entity\Poi;
use Game\MapBundle\Entity\Repository\PoiRepository;

class PoiManager extends CoreManager
{
    /**
     * @return PoiRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @param Game $game
     * @return mixed
     */
    public function getStartingPoi(Game $game)
    {
        return $this->getRepository()->findStartingPoi($game);
    }
}
