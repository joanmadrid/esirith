<?php

namespace Game\MapBundle\Manager;


use Doctrine\Common\Collections\Collection;
use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Model\Roll;
use Game\MapBundle\Entity\Path;
use Game\MapBundle\Entity\Repository\MapRepository;
use Game\MapBundle\Entity\Repository\PathRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MapManager extends CoreManager
{

    /**
     * @param Path $path
     *
     * @param Roll $diceRoll
     *
     * @return bool
     */
    public function triggerBattle(Path $path, $diceRoll)
    {
        $danger = $path->getDanger();

        return $diceRoll->getRollResult() < $danger;
    }

    /**
     * @return Collection
     */
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * @param $start
     * @param $end
     *
     * @return \Game\MapBundle\Entity\Path
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function findPathToPoi($start, $end)
    {
        $path = $this->getPathRepository()->findToPoi($start, $end);

        if (!$path) {
            throw new NotFoundHttpException('Path not found');
        }

        return $path;
    }

    /**
     * @return MapRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @return PathRepository
     */
    protected function getPathRepository()
    {
        return $this->getManager()->getRepository('MapBundle:Path');
    }
}
