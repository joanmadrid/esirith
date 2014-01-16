<?php
namespace Game\NpcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;

/**
 * Class Humanoid
 *
 * @ORM\Entity()
 * @ORM\Table(name="humanoid",
 *            options={"comment" = "Tabla abstracta de npc's humanoides"})
 * @ORM\InheritanceType("JOINED")
 * @DiscriminatorColumn(name="type", type="smallint")
 * @DiscriminatorMap({"1" = "Game\NpcBundle\Entity\Human"})
 *
 * @package Game\NpcBundle\Entity
 */
abstract class Humanoid extends Npc
{

} 