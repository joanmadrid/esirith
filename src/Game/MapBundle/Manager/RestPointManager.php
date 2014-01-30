<?php

namespace Game\MapBundle\Manager;

use Doctrine\Common\Collections\Collection;
use Game\CoreBundle\Manager\CoreManager;
use Game\CharacterBundle\Entity\Character;
use Game\MapBundle\Entity\RestPoint;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Game\CoreBundle\Model\Roll;
use Game\CoreBundle\Manager\RollManager;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Game\CharacterBundle\Event\CharacterEvent;
use Game\CharacterBundle\CharacterEventList;

class RestPointManager extends CoreManager
{

    /**
     * Duerme completamente, en un sitio seguro
     */
    const REST_RESULT_SAFE = 1;

    /**
     * Duerme ok, en un sitio peligroso
     */
    const REST_RESULT_OK = 2;

    /**
     * Tiene problemas durante el sueño
     */
    const REST_RESULT_DANGER = 3;

    /**
     * No tiene dinero para pagar la posada
     */
    const REST_RESULT_NOT_ENOUGH_MONEY = 4;

    /** @var RollManager */
    protected $rollManager;

    /** @var EventDispatcher */
    protected $eventDispatcher;

    /**
     * @param $rollManager
     */
    public function setRollManager($rollManager)
    {
        $this->rollManager = $rollManager;
    }

    /**
     * @param $eventDispatcher
     */
    public function setEventDispatcher($eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Mira si pude descansar y devuelve un resultado
     *
     * @param Character $char
     * @param RestPoint $restPoint
     * @return int
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getRestResult(Character $char, RestPoint $restPoint)
    {
        //no está en el sitio donde quiere dormir
        if ($char->getCurrentPoi() != $restPoint->getPoi()) {
            throw new NotFoundHttpException('Invalid Poi');
        }

        // si esta en una posada y tiene pasta
        if ($restPoint->getType() == RestPoint::REST_POINT_TYPE_INN) {
            if ($char->getGold() >= $restPoint->getCost()) {
                return self::REST_RESULT_SAFE;
            } else {
                return self::REST_RESULT_NOT_ENOUGH_MONEY;
            }
        } else {
            if ($this->rollManager->roll(1, 100)->getRollResult() > $restPoint->getDanger()) {
                return self::REST_RESULT_OK;
            } else {
                return self::REST_RESULT_DANGER;
            }
        }
    }

    /**
     * Perform a rest
     *
     * @param Character $char
     * @param $restResult
     * @return \Symfony\Component\EventDispatcher\Event
     */
    public function rest(Character $char, $restResult)
    {
        /** @var CharacterEvent $characterEvent */
        $characterEvent = new CharacterEvent($char);
        $characterEvent->setRestType($restResult);
        $restore = $this->eventDispatcher->dispatch(CharacterEventList::REST, $characterEvent);
        $this->persist($char);
        return $restore;
    }
}