<?php

namespace Game\ShopBundle\Model;

class Buyout
{
    /** @var bool */
    protected $success;

    /** @var integer */
    protected $goldLeft;

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * @return boolean
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param int $goldLeft
     */
    public function setGoldLeft($goldLeft)
    {
        $this->goldLeft = $goldLeft;
    }

    /**
     * @return int
     */
    public function getGoldLeft()
    {
        return $this->goldLeft;
    }
}