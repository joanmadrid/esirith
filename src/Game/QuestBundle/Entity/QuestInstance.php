<?php

namespace Game\QuestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestInstance
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Game\QuestBundle\Entity\Repository\QuestInstanceRepository")
 */
class QuestInstance
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
     * @ORM\ManyToOne(targetEntity="Quest")
     * @ORM\JoinColumn(name="quest_id", referencedColumnName="id")
     */
    private $quest;

    /**
     * @ORM\ManyToOne(targetEntity="Game\CompanionBundle\Entity\Companion")
     * @ORM\JoinColumn(name="companion_id", referencedColumnName="id")
     */
    private $companion;


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
     * Set quest
     *
     * @param \Game\QuestBundle\Entity\Quest $quest
     * @return QuestInstance
     */
    public function setQuest(\Game\QuestBundle\Entity\Quest $quest = null)
    {
        $this->quest = $quest;
    
        return $this;
    }

    /**
     * Get quest
     *
     * @return \Game\QuestBundle\Entity\Quest 
     */
    public function getQuest()
    {
        return $this->quest;
    }

    /**
     * Set companion
     *
     * @param \Game\CompanionBundle\Entity\Companion $companion
     * @return QuestInstance
     */
    public function setCompanion(\Game\CompanionBundle\Entity\Companion $companion = null)
    {
        $this->companion = $companion;
    
        return $this;
    }

    /**
     * Get companion
     *
     * @return \Game\CompanionBundle\Entity\Companion 
     */
    public function getCompanion()
    {
        return $this->companion;
    }
}