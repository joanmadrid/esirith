<?php

namespace Game\GameBundle\Manager;

use Game\CharacterBundle\Entity\Character;
use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\GameBundle\Entity\Boss;
use Game\GameBundle\Entity\Raid;
use Game\GameBundle\Entity\Repository\RaidRepository;
use Game\MapBundle\Entity\Poi;

class RaidManager extends CoreManager
{

    /** @var RollManager */
    protected $rollManager;

    /**
     * @return RaidRepository
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
     * @param Boss $boss
     * @return array
     */
    public function getActiveRaids(Boss $boss)
    {
        return $this->getRepository()->getActiveRaids($boss);
    }

    /**
     * @param Character $char
     * @param Boss $boss
     * @return bool
     */
    public function getCharacterRaidAgainstBoss(Character $char, Boss $boss)
    {
        if ($this->getRepository()->getCharacterRaidAgainstBoss($char, $boss)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param Character $char
     * @param Poi $poi
     * @param Boss $boss
     * @return bool
     */
    public function checkIsRaidAvailable(Character $char, Poi $poi, Boss $boss)
    {
        return ($boss->getCurrentPoi() == $poi && !$this->getCharacterRaidAgainstBoss($char, $boss));
    }

    /**
     * @param Character $char
     * @param Poi $poi
     * @param Boss $boss
     * @return bool
     */
    public function joinRaid(Character $char, Poi $poi, Boss $boss)
    {
        if ($this->checkIsRaidAvailable($char, $poi, $boss)) {
            $raid = new Raid();
            $raid->setCharacter($char);
            $raid->setBoss($boss);
            $raid->setStatus(Raid::STATUS_WAITING);
            $raid->setCreated(new \DateTime());
            $this->persist($raid);
            return true;
        } else {
            return false;
        }
    }
}
