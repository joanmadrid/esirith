<?php

namespace Game\QuestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quest
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\QuestBundle\Entity\Repository\QuestRepository")
 */
class Quest
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="gold", type="integer")
     */
    private $gold;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="QuestInstance", mappedBy="quest")
     */
    private $questInstances;


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
     * @return Quest
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
     * Set description
     *
     * @param string $description
     * @return Quest
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set gold
     *
     * @param integer $gold
     * @return Quest
     */
    public function setGold($gold)
    {
        $this->gold = $gold;
    
        return $this;
    }

    /**
     * Get gold
     *
     * @return integer 
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Quest
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Quest
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
     * Constructor
     */
    public function __construct()
    {
        $this->questInstances = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add questInstances
     *
     * @param \Game\QuestBundle\Entity\QuestInstance $questInstances
     * @return Quest
     */
    public function addQuestInstance(\Game\QuestBundle\Entity\QuestInstance $questInstances)
    {
        $this->questInstances[] = $questInstances;
    
        return $this;
    }

    /**
     * Remove questInstances
     *
     * @param \Game\QuestBundle\Entity\QuestInstance $questInstances
     */
    public function removeQuestInstance(\Game\QuestBundle\Entity\QuestInstance $questInstances)
    {
        $this->questInstances->removeElement($questInstances);
    }

    /**
     * Get questInstances
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestInstances()
    {
        return $this->questInstances;
    }
}