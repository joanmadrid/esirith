<?php

namespace Game\QuestBundle\Manager;

use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\QuestBundle\Entity\Repository\QuestInstanceRepository;

class QuestInstanceManager extends CoreManager
{
    /** @var RollManager */
    private $rollManager;

    /**
     * @return QuestInstanceRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @param RollManager $rollManager
     */
    public function setRollManager($rollManager)
    {
        $this->rollManager = $rollManager;
    }
}
