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

class InventoryController extends Controller
{
    /**
     * @Route("/index", name="character.inventory.index")
     * @Template()
     */
    public function indexAction()
    {
        //personaje activo
        $char = $this->getDoctrine()->getRepository('GameCharacterBundle:Character')->findOneByName('Conan');

        //items
        $items = $this->getDoctrine()->getRepository('GameCharacterBundle:CharacterItem')->findItemsByCharacter($char);

        return array(
            'char' => $char,
            'items' => $items
        );
    }

    /**
     * @Route("/equip/{id}", name="character.inventory.equip", requirements={"id" = "\d+"})
     * @Template()
     * @ParamConverter("map", class="GameCharacterBundle:CharacterItem")
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
     * @ParamConverter("map", class="GameCharacterBundle:CharacterItem")
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
     * @return object
     */
    private function getCharacterItemManager()
    {
        return $this->get('character.characteritem_manager');
    }

    /**
     * @Route("/dpstest/{id}", name="character.inventory.dpstest", requirements={"id" = "\d+"})
     * @Template()
     * @ParamConverter("map", class="GameCharacterBundle:CharacterItem")
     */
    public function dpsTestAction(CharacterItem $item)
    {
        $weaponManager = $this->getWeaponManager();

        if ($weaponManager->isWeapon($item->getItem())) {
            /** @var Roll $damageRoll */
            $damageRoll = $weaponManager->rollDamage($item->getItem());
            $this->get('session')->getFlashBag()->add('success',
                'Damage roll: '.$damageRoll->getRollResult()
            );
        }
        return $this->redirect($this->generateUrl('character.inventory.index'));
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
}
