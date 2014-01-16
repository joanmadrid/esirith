<?php

namespace Game\CharacterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CharacterItem
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\CharacterBundle\Entity\CharacterItemRepository")
 */
class CharacterItem
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
     * @ORM\ManyToOne(targetEntity="Game\ItemBundle\Entity\Item", inversedBy="characterItems")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $item;

    /**
     * @ORM\ManyToOne(targetEntity="Character", inversedBy="characterItems")
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id")
     */
    private $character;


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
     * Set item
     *
     * @param \Game\ItemBundle\Item $item
     * @return CharacterItem
     */
    public function setItem(\Game\ItemBundle\Item $item = null)
    {
        $this->item = $item;
    
        return $this;
    }

    /**
     * Get item
     *
     * @return \Game\ItemBundle\Item 
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set character
     *
     * @param \Game\CharacterBundle\Entity\Character $character
     * @return CharacterItem
     */
    public function setCharacter(\Game\CharacterBundle\Entity\Character $character = null)
    {
        $this->character = $character;
    
        return $this;
    }

    /**
     * Get character
     *
     * @return \Game\CharacterBundle\Entity\Character 
     */
    public function getCharacter()
    {
        return $this->character;
    }
}