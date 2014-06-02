<?php

namespace Game\BattleBundle\Controller;

use Game\MonsterBundle\Manager\LootManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Game\BattleBundle\Manager\BattleManager;
use Game\UserBundle\Manager\UserManager;
use Game\BattleBundle\Entity\Battle;
use Game\CharacterBundle\Entity\Character;

class BattleController extends Controller
{

}