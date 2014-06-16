<?php

namespace Game\QuestBundle\Manager;

use Game\CharacterBundle\Entity\Character;
use Game\CoreBundle\Manager\CoreManager;
use Game\QuestBundle\Entity\Quest;
use Game\QuestBundle\Entity\Repository\QuestRepository;

class QuestManager extends CoreManager
{
    /**
     * @return QuestRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    ///

    /**
     * @param Character $char
     * @return array
     */
    public function getQuests(Character $char)
    {
        return $this->getRepository()->findQuests($char->getLevel());
    }
}
