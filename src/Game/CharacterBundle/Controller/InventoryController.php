<?php

namespace Game\CharacterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Game\CharacterBundle\Entity\CharacterItem;
use Game\CharacterBundle\Manager\CharacterItemManager;
use Symfony\Component\HttpFoundation\Response;
use Game\CoreBundle\Model\Roll;
use Game\UserBundle\Manager\UserManager;

class InventoryController extends Controller
{
    /**
     * @Route("/index", name="character.inventory.index")
     * @Template()
     */
    public function indexAction()
    {
        //personaje activo
        $char = $char = $this->getUserManager()->getCharacter();

        // default dead check
        if ($char->checkIsDead()) {
            return $this->redirect($this->generateUrl('character.death'));
        }

        //items
        $items = $this->getDoctrine()->getRepository('CharacterBundle:CharacterItem')->findItemsByCharacter($char);

        return array(
            'char' => $char,
            'items' => $items
        );
    }

    /**
     * @Route("/equip/{id}", name="character.inventory.equip", requirements={"id" = "\d+"})
     * @Template()
     * @ParamConverter("map", class="CharacterBundle:CharacterItem")
     */
    public function equipAction(CharacterItem $item)
    {
        $characterItemManager = $this->getCharacterItemManager();

        if (!$characterItemManager->equip($item)) {
            $this->get('session')->getFlashBag()->add('error',
                'No puedes equiparte este objeto'
            );
        }
        return $this->redirect($this->generateUrl('character.inventory.index'));
    }

    /**
     * @Route("/unequip/{id}", name="character.inventory.unequip", requirements={"id" = "\d+"})
     * @Template()
     * @ParamConverter("map", class="CharacterBundle:CharacterItem")
     */
    public function unequipAction(CharacterItem $item)
    {
        $characterItemManager = $this->getCharacterItemManager();

        if (!$characterItemManager->unequip($item)) {
            $this->get('session')->getFlashBag()->add('error',
                'No puedes desequiparte este objeto'
            );
        }
        return $this->redirect($this->generateUrl('character.inventory.index'));
    }

    /**
     * @Route("/use/{id}", name="character.inventory.use", requirements={"id" = "\d+"})
     * @Template()
     * @ParamConverter("map", class="CharacterBundle:CharacterItem")
     */
    public function useAction(CharacterItem $item)
    {
        if (!$this->getCharacterItemManager()->utilize($item)) {
            $this->get('session')->getFlashBag()->add('error',
                'No puedes usar este objeto'
            );
        } else {
            $this->get('session')->getFlashBag()->add('info',
                'Has utilizado '.$item->getItem()->getName().'.'
            );
            $this->getCharacterItemManager()->flush();
        }
        return $this->redirect($this->generateUrl('character.inventory.index'));
    }

    /**
     * @return CharacterItemManager
     */
    private function getCharacterItemManager()
    {
        return $this->get('character.characteritem_manager');
    }

    /**
     * Devuelve el servicio WeaponManager
     *
     * @return object
     */
    private function getWeaponManager()
    {
        return $this->get('item.weapon_manager');
    }

    /**
     * @return UserManager;
     */
    private function getUserManager()
    {
        return $this->get('user.user_manager');
    }
}
