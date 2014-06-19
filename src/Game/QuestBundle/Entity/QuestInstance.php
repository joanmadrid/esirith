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
    const STATUS_PENDING = 0;
    const STATUS_DONE = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Quest", inversedBy="questInstances")
     * @ORM\JoinColumn(name="quest_id", referencedColumnName="id")
     */
    private $quest;

    /**
     * @ORM\ManyToOne(targetEntity="Game\CompanionBundle\Entity\Companion", inversedBy="questInstances")
     * @ORM\JoinColumn(name="companion_id", referencedColumnName="id")
     */
    private $companion;

    /**
     * @ORM\Column(name="end", type="datetime")
     */
    private $end;

    /**
     * @ORM\Column(name="status", type="integer")
     */
    private $status = 0;


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

    /**
     * @param \DateTime $end
     * @return $this
     */
    public function setEnd($end)
    {
        $this->end = $end;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
}
