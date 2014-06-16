<?php

namespace Game\QuestBundle\Controller;

use Game\CompanionBundle\Manager\CompanionManager;
use Game\QuestBundle\Entity\Quest;
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
        $companions = $this->getCompanionManager()->getAvailableCompanionsForQuest($char);
        return array(
            'char' => $char,
            'quests' => $quests,
            'companions' => $companions
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
