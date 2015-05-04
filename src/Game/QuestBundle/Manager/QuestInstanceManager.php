<?php

namespace Game\QuestBundle\Manager;

use Game\CharacterBundle\Entity\Character;
use Game\CompanionBundle\Entity\Companion;
use Game\CompanionBundle\Model\CompanionBuffs;
use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\QuestBundle\Entity\Quest;
use Game\QuestBundle\Entity\QuestInstance;
use Game\QuestBundle\Entity\Repository\QuestInstanceRepository;
use Game\QuestBundle\Model\Reward;
use Symfony\Component\Validator\Constraints\DateTime;

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

    /////

    /**
     * @param Character $char
     * @param Quest $quest
     * @param $status
     * @return mixed
     */
    public function getQuestInstanceForStatus(Character $char, Quest $quest, $status)
    {
        return $this->getRepository()->getQuestInstanceForStatus($char, $quest, $status);
    }

    /**
     * @param Character $char
     * @param Quest $quest
     * @return bool
     */
    public function canGoToQuest(Character $char, Quest $quest)
    {
        $questInstance = $this->getQuestInstanceForStatus($char, $quest, QuestInstance::STATUS_PENDING);

        return
            $quest->getLevel() <= $char->getLevel()
            && $questInstance == null
        ;
    }

    /**
     * @param Companion $companion
     * @param Quest $quest
     * @internal param \Game\CompanionBundle\Model\CompanionBuffs $compBuffs
     * @return QuestInstance|null
     */
    public function goToQuest(Companion $companion, Quest $quest)
    {
        $char = $companion->getCharacter();
        if ($this->canGoToQuest($char, $quest)) {

            $endTime = new \DateTime();

            if ($companion->getAbility() == Companion::ABILITY_ADVENTURER) {
                $endTime->modify('+'.Quest::HOURS_TO_COMPLETE_ADVENTURER.' hours');
            } else {
                $endTime->modify('+'.Quest::HOURS_TO_COMPLETE.' hours');
            }

            $questInstance = new QuestInstance();
            $questInstance->setCompanion($companion);
            $questInstance->setQuest($quest);
            $questInstance->setEnd($endTime);
            $this->persist($questInstance);
            return $questInstance;
        } else {
            return null;
        }
    }

    /**
     * @param Character $char
     * @param QuestInstance $questInstance
     * @return bool
     */
    public function canGetReward(Character $char, QuestInstance $questInstance)
    {
        $now = new \DateTime();
        return
            $char == $questInstance->getCompanion()->getCharacter()
            && $now >= $questInstance->getEnd()
            && $questInstance->getStatus() == QuestInstance::STATUS_PENDING
        ;
    }

    /**
     * @param Character $char
     * @param QuestInstance $questInstance
     * @return Reward|null
     */
    public function getReward(Character $char, QuestInstance $questInstance)
    {
        if ($this->canGetReward($char, $questInstance)) {
            //changing status
            $questInstance->setStatus(QuestInstance::STATUS_DONE);
            $this->persist($questInstance);

            //reward
            $reward = new Reward();
            $reward->setGold($questInstance->getQuest()->getGold());
            $reward->setXp(Quest::XP);

            //giving to char
            $char->addXP($reward->getXp());
            $char->addGold($reward->getGold());
            $this->persist($char);

            //giving to companion
            $companion = $questInstance->getCompanion();
            $companion->addXP($reward->getXp());
            $this->persist($companion);

            return $reward;
        } else {
            return null;
        }
    }

    /**
     * @param QuestInstance $questInstance
     * @return string|null
     */
    public function getTimeLeftForReward(QuestInstance $questInstance)
    {
        $now = new \DateTime();
        $end = $questInstance->getEnd();
        if ($now > $end) {
            return null;
        } else {
            $interval = $now->diff($end);
            return $interval->format('%H:%I:%S');
        }
    }
}
