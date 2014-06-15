<?php

namespace Game\QuestBundle\Resources;

use Game\CoreBundle\Manager\CoreManager;
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
}
