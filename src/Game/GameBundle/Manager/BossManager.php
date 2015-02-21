<?php

namespace Game\GameBundle\Manager;

use Game\CharacterBundle\Entity\Character;
use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\GameBundle\Entity\Boss;
use Game\GameBundle\Entity\Raid;
use Game\GameBundle\Entity\Repository\BossRepository;
use Game\MapBundle\Entity\Poi;

class BossManager extends CoreManager
{
    const HP_STATUS_INTACT = 0;
    const HP_STATUS_LIGHTLY_WOUNDED = 1;
    const HP_STATUS_WOUNDED = 2;
    const HP_STATUS_SERIOUSLY_WOUNDED = 3;
    const HP_STATUS_NEARLY_DEAD = 4;

    const INFECTION_FIGHT_CHANCE = 50;
    const INFECTION_FIGHT_WIN_XP = 5;
    const INFECTION_FIGHT_LOSE_HP = 5;

    const RAID_FIGHT_CHANCE = 50;
    const RAID_FIGHT_WIN_XP = 10;
    const RAID_FIGHT_LOSE_HP = 10;
    const RAID_FIGHT_BOSS_LOSE_HP = 200;

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

    /**
     * @param Boss $boss
     */
    public function propagateInfection(Boss $boss)
    {
        //start from a point
        if (!$boss->getCurrentPoi()) {
            $startingPoi = $this->em->getRepository('MapBundle:Poi')->getRandomNotInfected();
            $boss->setCurrentPoi($startingPoi);
            $this->persist($boss);
        } else {
            /** @var Poi $nextPoi */
            $nextPoi = $this->getPoiToInfect($boss);
            $nextPoi->setInfected(true);
            $this->persist($nextPoi);
        }
    }

    /**
     * gamedo: buscar un sitio para propagar, de uno que ya este infectado
     * @param Boss $boss
     * @return Poi
     */
    private function getPoiToInfect(Boss $boss)
    {
        return $this->em->getRepository('MapBundle:Poi')->getRandomNotInfected();
    }

    /**
     * gamedo: atacar a todos los POIS infectados (los PJ que estén ahí)
     * @param Boss $boss
     */
    public function attackInfectedPois(Boss $boss)
    {

    }

    /**
     * gamedo: hacer la logica, ahora es random
     * gamedo: que pasa si el boss muere?
     * gamedo: que pasa si mueren todos los PJ?
     * @param Boss $boss
     * @param $raids
     * @return bool
     */
    public function resolveRaid(Boss $boss, $raids)
    {
        $success = $this->rollManager->rollPercentEqualOrBelow(self::RAID_FIGHT_CHANCE);

        //character - raid logic
        foreach ($raids as $raid) {
            /** @var $raid Raid */
            $char = $raid->getCharacter();
            if ($success) {
                $raid->setStatus(Raid::STATUS_WON);
                $char->addXP(self::RAID_FIGHT_WIN_XP);
            } else {
                $raid->setStatus(Raid::STATUS_LOST);
                $char->decreaseHP(self::RAID_FIGHT_LOSE_HP);
            }
            $this->persist($raid);
            $this->persist($char);
        }

        //boss logic
        if ($success) {
            $boss->decreaseHP(self::RAID_FIGHT_BOSS_LOSE_HP);
            $this->persist($boss);
        }

        return $success;
    }

    /**
     * @param Character $char
     * @param Poi $poi
     * @return bool
     */
    public function fightInfection(Character $char, Poi $poi)
    {
        $success = $this->rollManager->rollPercentEqualOrBelow(self::INFECTION_FIGHT_CHANCE);
        if ($success) {
            $poi->setInfected(false);
            $char->addXP(self::INFECTION_FIGHT_WIN_XP);
            $this->persist($poi);
        } else {
            $char->decreaseHP(self::INFECTION_FIGHT_LOSE_HP);
            $char->checkIsDead();
        }
        $this->persist($char);

        return $success;
    }

    /**
     * @param Poi $poi
     * @return Boss
     */
    public function getBossFromPoi(Poi $poi)
    {
        return $this->getRepository()->getBossFromPoi($poi);
    }
}
