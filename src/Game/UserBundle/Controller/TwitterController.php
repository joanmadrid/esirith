<?php

namespace Game\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class TwitterController extends Controller
{
    /**
     * @Route("/test", name="user.twitter.test")
     * @Template()
     */
    public function testAction()
    {

    }
}
