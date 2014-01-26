<?php
namespace Game\NpcBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Npc
 *
 * @ORM\Entity()
 * @UniqueEntity("internalName")
 *
 * @ORM\Table(name="npc", options={"comment" = "Tabla de npc's"})
 *
 * @package Game\NpcBundle\Entity
 */
class Npc
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Game\NpcBundle\Entity\Race")
     * @ORM\JoinColumn(name="race_id", referencedColumnName="id")
     */
    protected $race;

    /**
     * @var string
     *
     * @ORM\Column(name="internal_name", type="string", length=255)
     */
    protected $internalName;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var int
     *
     * @ORM\Column(name="hp", type="integer")
     */
    protected $hp;

    /**
     * @var int
     *
     * @ORM\Column(name="current_hp", type="integer")
     */
    protected $currentHp;

    /**
     * @var integer
     *
     * @ORM\Column(name="damage", type="integer")
     */
    protected $damage;

    /**
     * @ORM\OneToMany(targetEntity="Game\NpcBundle\Entity\Spawn", mappedBy="npc")
     */
    protected $spawnList;

    /**
     * @param int $hp
     *
     * @return $this
     */
    public function setHp($hp)
    {
        $this->hp = $hp;

        return $this;
    }

    /**
     * @return int
     */
    public function getHp()
    {
        return $this->hp;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $internalName
     *
     * @return $this
     */
    public function setInternalName($internalName)
    {
        $this->internalName = $internalName;

        return $this;
    }

    /**
     * @return string
     */
    public function getInternalName()
    {
        return $this->internalName;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $damage
     *
     * @return $this
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;

        return $this;
    }

    /**
     * @return int
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @param mixed $race
     *
     * @return $this
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param int $currentHp
     *
     * @return $this
     */
    public function setCurrentHp($currentHp)
    {
        $this->currentHp = $currentHp;

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentHp()
    {
        return $this->currentHp;
    }

    /**
     * @param Spawn $spawn
     * @return Spawn
     */
    public function addSpawn(Spawn $spawn)
    {
        $this->spawnList[] = $spawn;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSpawnList()
    {
        return $this->spawnList;
    }
}
