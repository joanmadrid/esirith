<?php

namespace Game\CharacterBundle\Manager;

use Game\CharacterBundle\Entity\Character;
use Game\CharacterBundle\Entity\Repository\CharacterRepository;
use Game\CoreBundle\Manager\CoreManager;
use Game\MapBundle\Entity\Poi;

class CharacterManager extends CoreManager
{

    /**
     * @param Character $character
     * @param Poi $poi
     */
    public function move(Character $character, Poi $poi)
    {
        $character->setCurrentPoi($poi);
        $this->persist($character);
    }

    /**
     * @param $name
     *
     * @return \Game\CharacterBundle\Entity\Character
     */
    public function findByName($name)
    {
        return $this->getRepository()->findByName($name);
    }

    /**
     * @param $name
     *
     * @return \Game\CharacterBundle\Entity\Character
     */
    public function findByNameWithPoi($name)
    {
        return $this->getRepository()->findByNameWithPoi($name);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->getRepository()->findById($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findByIdForStatus($id)
    {
        return $this->getRepository()->findByIdForStatus($id);
    }

    /**
     * @return CharacterRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }
}
