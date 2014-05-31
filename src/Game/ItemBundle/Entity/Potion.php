<?php

namespace Game\ItemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Potion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\ItemBundle\Entity\Repository\PotionRepository")
 */
class Potion extends Item
{
    const POTION_TYPE_HEAL = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="potionType", type="integer")
     */
    private $potionType = 0;

    public function __construct()
    {
        $this->setIsEquipable(false);
        $this->setIsUsable(true);
    }

    /**
     * @param mixed $potionType
     */
    public function setPotionType($potionType)
    {
        $this->potionType = $potionType;
    }

    /**
     * @return mixed
     */
    public function getPotionType()
    {
        return $this->potionType;
    }
}