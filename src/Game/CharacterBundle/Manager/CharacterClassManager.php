<?php

namespace Game\CharacterBundle\Manager;

use Game\CharacterBundle\Entity\CharacterClass;
use Game\CoreBundle\Manager\CoreManager;

class CharacterClassManager extends CoreManager
{
    /**
     * @return CharacterRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @return array
     */
    public function getSelectableClasses()
    {
        return $this->getRepository()->findClasses();
    }

    /**
     * @param $classId
     * @return CharacterClass
     */
    public function findClass($classId)
    {
        return $this->getRepository()->findOneById($classId);
    }
} 