<?php

namespace Game\CoreBundle\Model;

class Roll
{
    protected $rollResult;

    protected $isCritical;

    /**
     * @param mixed $isCritical
     */
    public function setIsCritical($isCritical)
    {
        $this->isCritical = $isCritical;
    }

    /**
     * @return mixed
     */
    public function getIsCritical()
    {
        return $this->isCritical;
    }

    /**
     * @param mixed $rollResult
     */
    public function setRollResult($rollResult)
    {
        $this->rollResult = $rollResult;
    }

    /**
     * @return mixed
     */
    public function getRollResult()
    {
        return $this->rollResult;
    }

    public function __construct()
    {

    }
}