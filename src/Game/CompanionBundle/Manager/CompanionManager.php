<?php

namespace Game\CompanionBundle\Manager;

use Game\CharacterBundle\Entity\Character;
use Game\CharacterBundle\Manager\PortraitManager;
use Game\CompanionBundle\Entity\Companion;
use Game\CompanionBundle\Entity\Repository\CompanionRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\NameGeneratorManager;
use Game\CoreBundle\Manager\RollManager;

class CompanionManager extends CoreManager
{
    const REGENERATE_DAYS = 1;
    const REGENERATE_GOLD = 50;

    const HIRE_GOLD = 100;

    const PARTY_MAX_COMPANIONS = 4;

    /** @var RollManager */
    private $rollManager;

    /** @var PortraitManager */
    private $portraitManager;

    /** @var NameGeneratorManager */
    private $nameGeneratorManager;

    /**
     * @return CompanionRepository
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
     * @param PortraitManager $portraitManager
     */
    public function setPortraitManager($portraitManager)
    {
        $this->portraitManager = $portraitManager;
    }

    /**
     * @param NameGeneratorManager $nameGeneratorManager
     */
    public function setNameGeneratorManager($nameGeneratorManager)
    {
        $this->nameGeneratorManager = $nameGeneratorManager;
    }

    /////

    /**
     * @param Character $char
     * @return mixed
     */
    public function getPendingCompanion(Character $char)
    {
        return $this->getRepository()->getPendingCompanion($char);
    }

    /**
     * @param Character $char
     * @return array
     */
    public function getParty(Character $char)
    {
        return $this->getRepository()->getInPartyCompanions($char);
    }

    /**
     * @param $char
     * @return mixed
     */
    public function getPartySize($char)
    {
        return $this->getRepository()->getPartySize($char);
    }

    /**
     * @param Character $char
     * @return Companion
     */
    public function generateRandomCompanion(Character $char)
    {
        $pending = $this->getPendingCompanion($char);

        if ($pending) {
            $this->remove($pending);
        }

        $types = array(Companion::TYPE_WARRIOR, Companion::TYPE_WIZARD, Companion::TYPE_CLERIC, Companion::TYPE_THIEF);
        $abilities = array(Companion::ABILITY_ADVENTURER, Companion::ABILITY_FIGHTER, Companion::ABILITY_HONORABLE);
        $gender = mt_rand(1, 2);
        $portrait = $this->portraitManager->generateRandom(
            ($gender == Companion::GENDER_MALE ? 'human-male' : 'human-female'),
            array($char->getPortrait())
        );

        //companion
        $companion = new Companion();
        $companion->setLevel(1);
        $companion->setXp(0);
        $companion->setName($this->nameGeneratorManager->generateCharacterName($gender));
        $companion->setStatus(Companion::STATUS_PENDING);
        $companion->setType($types[mt_rand(0, count($types)-1)]);
        $companion->setAbility($abilities[mt_rand(0, count($abilities)-1)]);
        $companion->setCharacter($char);
        $companion->setGender($gender);
        $companion->setPortrait(implode('/', $portrait));

        //gold for generation
        $char->removeGold(self::REGENERATE_GOLD);
        $char->setLastCompanionGeneration(new \DateTime());

        $this->persist($char);
        $this->persist($companion);

        return $companion;
    }

    /**
     * @param Character $char
     * @return bool
     */
    public function canRegenerateCompanion(Character $char)
    {
        $validDate = new \DateTime();
        $validDate->sub(new \DateInterval('P'.self::REGENERATE_DAYS.'D'));
        return $char->getLastCompanionGeneration() < $validDate && $char->getGold() >= self::REGENERATE_GOLD;
    }

    /**
     * @param Character $char
     * @return \DateTime
     */
    public function getTimeLeftForRegenerateCompanion(Character $char)
    {
        $validDate = new \DateTime();
        $validDate->sub(new \DateInterval('P'.self::REGENERATE_DAYS.'D'));
        $last = $char->getLastCompanionGeneration();
        $interval = $last->diff($validDate);
        return $interval->format('%H:%I:%S');
    }

    /**
     * @param Character $char
     * @param Companion $companion
     * @return bool
     */
    public function hireCompanion(Character $char, Companion $companion)
    {
        if ($char->getGold() >= self::HIRE_GOLD && $this->getPartySize($char) < self::PARTY_MAX_COMPANIONS) {
            $companion->setStatus(Companion::STATUS_IN_PARTY);
            $this->persist($companion);
            return true;
        } else {
            return false;
        }
    }
}
