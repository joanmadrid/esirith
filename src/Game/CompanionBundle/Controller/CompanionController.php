<?php

namespace Game\CompanionBundle\Controller;

use Game\CompanionBundle\Entity\Companion;
use Game\CompanionBundle\Manager\CompanionManager;
use Game\UserBundle\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CompanionController extends Controller
{
    /**
     * @Route("/", name="companion.index")
     * @Template()
     */
    public function indexAction()
    {
        $char               = $this->getUserManager()->getCharacter();
        $pendingCompanion   = $this->getCompanionManager()->getPendingCompanion($char);
        $canGenerate        = $this->getCompanionManager()->canRegenerateCompanion($char);
        $party              = $this->getCompanionManager()->getParty($char);
        $timeLeft           = null;

        if (!$canGenerate) {
            $timeLeft = $this->getCompanionManager()->getTimeLeftForRegenerateCompanion($char);
        }

        return array(
            'char'          => $char,
            'canGenerate'   => $canGenerate,
            'pending'       => $pendingCompanion,
            'party'         => $party,
            'timeLeft'      => $timeLeft
        );
    }

    /**
     * @Route("/generate", name="companion.generate")
     */
    public function generateAction()
    {
        $char = $this->getUserManager()->getCharacter();
        if ($this->getCompanionManager()->canRegenerateCompanion($char)) {
            $this->getCompanionManager()->generateRandomCompanion($char);
            $this->getCompanionManager()->flush();
        } else {
            $this->get('session')->getFlashBag()->add(
                'error',
                "Can't generate new companion"
            );
        }
        return $this->redirect($this->generateUrl('companion.index'));
    }

    /**
     * @Route("/hire/{id}", name="companion.hire")
     * @ParamConverter("companion", class="CompanionBundle:Companion")
     */
    public function hireAction(Companion $companion)
    {
        $char = $this->getUserManager()->getCharacter();
        if ($this->getCompanionManager()->hireCompanion($char, $companion)) {
            $this->getCompanionManager()->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "You hired ".$companion->getName()." to join your party"
            );
        } else {
            $this->get('session')->getFlashBag()->add(
                'error',
                "Can't hire this companion"
            );
        }
        return $this->redirect($this->generateUrl('companion.index'));
    }

    /**
     * @return CompanionManager
     */
    private function getCompanionManager()
    {
        return $this->get('companion.companion_manager');
    }

    /**
     * @return UserManager
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }
}
