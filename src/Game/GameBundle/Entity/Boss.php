<?php

namespace Game\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boss
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\GameBundle\Entity\Repository\BossRepository")
 */
class Boss
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
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="current_hp", type="string", length=255)
     */
    private $currentHp;


    /**
     * @var string
     *
     * @ORM\Column(name="max_hp", type="string", length=255)
     */
    private $maxHP;

    /**
     * @ORM\OneToOne(targetEntity="Game", inversedBy="boss")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity="Game\MapBundle\Entity\Poi", inversedBy="bosses")
     * @ORM\JoinColumn(name="poi_id", referencedColumnName="id")
     */
    protected $currentPoi;


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
     * @return Boss
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
     * Set image
     *
     * @param string $image
     * @return Boss
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set game
     *
     * @param \Game\GameBundle\Entity\Game $game
     * @return Boss
     */
    public function setGame(\Game\GameBundle\Entity\Game $game = null)
    {
        $this->game = $game;
    
        return $this;
    }

    /**
     * Get game
     *
     * @return \Game\GameBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set currentHp
     *
     * @param string $currentHp
     * @return Boss
     */
    public function setCurrentHp($currentHp)
    {
        $this->currentHp = $currentHp;
    
        return $this;
    }

    /**
     * Get currentHp
     *
     * @return string 
     */
    public function getCurrentHp()
    {
        return $this->currentHp;
    }

    /**
     * Set maxHP
     *
     * @param string $maxHP
     * @return Boss
     */
    public function setMaxHP($maxHP)
    {
        $this->maxHP = $maxHP;
    
        return $this;
    }

    /**
     * Get maxHP
     *
     * @return string 
     */
    public function getMaxHP()
    {
        return $this->maxHP;
    }

    /**
     * Set currentPoi
     *
     * @param \Game\MapBundle\Entity\Poi $currentPoi
     * @return Boss
     */
    public function setCurrentPoi(\Game\MapBundle\Entity\Poi $currentPoi = null)
    {
        $this->currentPoi = $currentPoi;
    
        return $this;
    }

    /**
     * Get currentPoi
     *
     * @return \Game\MapBundle\Entity\Poi 
     */
    public function getCurrentPoi()
    {
        return $this->currentPoi;
    }
}