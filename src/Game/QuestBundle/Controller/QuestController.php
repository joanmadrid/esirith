<?php

namespace Game\QuestBundle\Controller;

use Game\CharacterBundle\Entity\Character;
use Game\CompanionBundle\Entity\Companion;
use Game\CompanionBundle\Manager\CompanionManager;
use Game\QuestBundle\Entity\Quest;
use Game\QuestBundle\Entity\QuestInstance;
use Game\QuestBundle\Manager\QuestInstanceManager;
use Game\QuestBundle\Manager\QuestManager;
use Game\UserBundle\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class QuestController extends Controller
{
    /**
     * @Route("/", name="quest.index")
     * @Template()
     */
    public function indexAction()
    {
        $char = $this->getUserManager()->getCharacter();
        $quests = $this->getQuestManager()->getQuests($char);

        return array(
            'char' => $char,
            'quests' => $quests
        );
    }

    /**
     * @Template()
     */
    public function renderQuestActionsAction(Quest $quest, Character $char)
    {
        $companions = $this->getCompanionManager()->getAvailableCompanionsForQuest($char);
        $questInstance = $this->getQuestInstanceManager()
            ->getQuestInstanceForStatus($char, $quest, QuestInstance::STATUS_PENDING);

        $timeLeft = null;
        if ($questInstance) {
            $timeLeft = $this->getQuestInstanceManager()->getTimeLeftForReward($questInstance);
        }

        return array(
            'quest' => $quest,
            'companions' => $companions,
            'questInstance' => $questInstance,
            'timeLeft' => $timeLeft
        );
    }

    /**
     * @Route("/send-to-quest/{companion}/{quest}", name="quest.send_to_quest", options={"expose"=true})
     * @ParamConverter("companion", class="CompanionBundle:Companion")
     * @ParamConverter("quest", class="QuestBundle:Quest")
     * @Template()
     */
    public function sendToQuestAction(Companion $companion, Quest $quest)
    {
        if (!$this->getQuestInstanceManager()->goToQuest($companion, $quest)) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'You can\'t go to this quest'
            );
        } else {
            $this->getQuestInstanceManager()->flush();
        }
        return $this->redirect($this->generateUrl('quest.index'));
    }

    /**
     * @Route("/collect-reward/{id}", name="quest.collect_reward")
     * @ParamConverter("questInstance", class="QuestBundle:QuestInstance")
     */
    public function collectRewardAction(QuestInstance $questInstance)
    {
        $char = $this->getUserManager()->getCharacter();
        $reward = $this->getQuestInstanceManager()->getReward($char, $questInstance);
        if ($reward) {
            $this->getQuestInstanceManager()->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'You collected the reward: '.$reward->getGold().' gold and '.$reward->getXp().' XP'
            );
        } else {
            $this->get('session')->getFlashBag()->add(
                'error',
                'You can\'t collect this reward'
            );
        }
        return $this->redirect($this->generateUrl('quest.index'));
    }

    /**
     * @return UserManager;
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }

    /**
     * @return QuestManager
     */
    private function getQuestManager()
    {
        return $this->get('quest.quest_manager');
    }

    /**
     * @return QuestInstanceManager
     */
    private function getQuestInstanceManager()
    {
        return $this->get('quest.questinstance_manager');
    }

    /**
     * @return CompanionManager
     */
    private function getCompanionManager()
    {
        return $this->get('companion.companion_manager');
    }
}
