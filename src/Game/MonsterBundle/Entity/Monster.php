<?php
namespace Game\MonsterBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Game\CharacterBundle\Entity\Attributes;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Monster
 *
 * @ORM\Entity()
 * @UniqueEntity("internalName")
 *
 * @ORM\Table(name="monster", options={"comment" = "Tabla de monser"})
 *
 * @package Game\MonsterBundle\Entity
 */
class Monster extends Attributes
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
     * @ORM\ManyToOne(targetEntity="Game\MonsterBundle\Entity\Race")
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
     * @ORM\OneToMany(targetEntity="Game\MonsterBundle\Entity\Spawn", mappedBy="monster")
     */
    protected $spawnList;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

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

    /**
     * @param string $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
