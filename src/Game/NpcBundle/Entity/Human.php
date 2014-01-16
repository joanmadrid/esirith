<?php
namespace Game\NpcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Human
 *
 * @ORM\Entity()
 * @ORM\Table(name="human",
 *            options={"comment" = "Npc's del tipo Humano"})
 *
 * @package Game\NpcBundle\Entity
 */
class Human extends Humanoid
{

} 