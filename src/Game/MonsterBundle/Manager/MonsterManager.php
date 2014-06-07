<?php

namespace Game\MonsterBundle\Manager;

use Game\BattleBundle\Model\BattleAttack;
use Game\BattleBundle\Model\BattlePlayer;
use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\MonsterBundle\Entity\Repository\MonsterRepository;

class MonsterManager extends CoreManager
{
    const ATTACK_DAMAGE_MULTIPLIER = 1.5;

    /** @var RollManager */
    private $rollManager;

    /**
     * @param RollManager $rollManager
     */
    public function setRollManager($rollManager)
    {
        $this->rollManager = $rollManager;
    }

    /**
     * @return MonsterRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @param BattlePlayer $monster
     * @param BattlePlayer $target
     * @return BattleAttack
     */
    public function attack(BattlePlayer $monster, BattlePlayer $target)
    {
        $damage = 0;
        $hits = 0;
        $miss = 0;
        $critical = 0;
        $monsterAttr = $monster->getPlayer();
        $targetAttr = $target->getPlayer();

        $attackRoll = $this->rollManager->roll(1, 20, 5);

        if ($attackRoll->getIsCritical()) {
            $damage = intval($monsterAttr->getDamage()*self::ATTACK_DAMAGE_MULTIPLIER);
            $hits++;
            $critical++;
        } else {
            if ($attackRoll->getRollResult() + $monsterAttr->getDex() >= $target->getComputedDefense()) {
                $hits++;
                $damage = mt_rand(1, $monsterAttr->getDamage());
            } else {
                $miss++;
            }
        }

        $battleAttack = new BattleAttack();
        $battleAttack->setCriticals($critical);
        $battleAttack->setDamage($damage);
        $battleAttack->setHits($hits);
        $battleAttack->setMiss($miss);
        return $battleAttack;
    }
}
