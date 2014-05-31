<?php

namespace Game\ItemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Weapon
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\ItemBundle\Entity\Repository\ArmorRepository")
 */
class Armor extends Item
{
    public function __construct()
    {
        $this->setIsEquipable(true);
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="defense", type="integer")
     */
    private $defense;

    /**
     * Set defense
     *
     * @param integer $defense
     * @return Armor
     */
    public function setDefense($defense)
    {
        $this->defense = $defense;
    
        return $this;
    }

    /**
     * Get defense
     *
     * @return integer 
     */
    public function getDefense()
    {
        return $this->defense;
    }
}