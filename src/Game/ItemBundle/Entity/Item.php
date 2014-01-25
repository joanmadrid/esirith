<?php

namespace Game\ItemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;

/**
 * Item
 *
 * @ORM\Entity(repositoryClass="Game\ItemBundle\Entity\Repository\ItemRepository")
 * @ORM\Table()
 * @ORM\InheritanceType("JOINED")
 * @DiscriminatorColumn(name="type", type="smallint")
 * @DiscriminatorMap({"1" = "Game\ItemBundle\Entity\Weapon"})
 */
abstract class Item
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Game\CharacterBundle\Entity\CharacterItem", mappedBy="item")
     */
    protected $characterItems;

    public function __construct()
    {
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Item
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add characterItems
     *
     * @param \Game\CharacterBundle\Entity\CharacterItem $characterItems
     * @return Item
     */
    public function addCharacterItem(\Game\CharacterBundle\Entity\CharacterItem $characterItems)
    {
        $this->characterItems[] = $characterItems;
    
        return $this;
    }

    /**
     * Remove characterItems
     *
     * @param \Game\CharacterBundle\Entity\CharacterItem $characterItems
     */
    public function removeCharacterItem(\Game\CharacterBundle\Entity\CharacterItem $characterItems)
    {
        $this->characterItems->removeElement($characterItems);
    }

    /**
     * Get characterItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCharacterItems()
    {
        return $this->characterItems;
    }
}