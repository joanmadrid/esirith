<?php

namespace Game\BattleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Game\BattleBundle\Entity\BattleMonster;

/**
 * Battle
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\BattleBundle\Entity\Repository\BattleRepository")
 */
class Battle
{
    const STATUS_PENDING = 0;
    const STATUS_WON = 1;
    const STATUS_LOST = 2;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Game\CharacterBundle\Entity\Character", inversedBy="battles")
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id")
     */
    private $character;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="BattleMonster", mappedBy="battle")
     */
    private $battleMonsters;


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
     * Constructor
     */
    public function __construct()
    {
        $this->battleMonsters = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set status
     *
     * @param integer $status
     * @return Battle
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set character
     *
     * @param \Game\CharacterBundle\Entity\Character $character
     * @return Battle
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

    /**
     * Add battleMonsters
     *
     * @param \Game\BattleBundle\Entity\BattleMonster $battleMonsters
     * @return Battle
     */
    public function addBattleMonster(\Game\BattleBundle\Entity\BattleMonster $battleMonsters)
    {
        $this->battleMonsters[] = $battleMonsters;
    
        return $this;
    }

    /**
     * Remove battleMonsters
     *
     * @param \Game\BattleBundle\Entity\BattleMonster $battleMonsters
     */
    public function removeBattleMonster(\Game\BattleBundle\Entity\BattleMonster $battleMonsters)
    {
        $this->battleMonsters->removeElement($battleMonsters);
    }

    /**
     * Get battleMonsters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBattleMonsters()
    {
        return $this->battleMonsters;
    }
}