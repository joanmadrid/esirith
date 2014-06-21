<?php

namespace Game\GameBundle\Manager;

use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\GameBundle\Entity\Repository\BossRepository;

class BossManager extends CoreManager
{
    const HP_STATUS_INTACT = 0;
    const HP_STATUS_LIGHTLY_WOUNDED = 1;
    const HP_STATUS_WOUNDED = 2;
    const HP_STATUS_SERIOUSLY_WOUNDED = 3;
    const HP_STATUS_NEARLY_DEAD = 4;

    /** @var RollManager */
    protected $rollManager;

    /**
     * @return BossRepository
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

    /**
     * @return string
     */
    public function getNextAttackTimeLeft()
    {
        $midnight = \DateTime::createFromFormat('U', strtotime('tomorrow midnight'));
        $now = new \DateTime();

        $timeLeft = $midnight->diff($now);
        return $timeLeft->format('%H:%I:%S');
    }

    /**
     * @param $currentHP
     * @param $totalHP
     * @return int
     */
    public function getHPStatus($currentHP, $totalHP)
    {
        $percent = intval(($currentHP * 100) / $totalHP);

        if ($percent > 80) {
            return self::HP_STATUS_INTACT;
        } elseif ($percent > 50) {
            return self::HP_STATUS_LIGHTLY_WOUNDED;
        } elseif ($percent > 20) {
            return self::HP_STATUS_WOUNDED;
        } elseif ($percent > 10) {
            return self::HP_STATUS_SERIOUSLY_WOUNDED;
        } else {
            return self::HP_STATUS_NEARLY_DEAD;
        }
    }
}
