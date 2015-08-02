<?php

namespace Game\GameBundle\Manager;

use Game\CoreBundle\Manager\CoreManager;
use Game\CoreBundle\Manager\RollManager;
use Game\GameBundle\Entity\Boss;
use Game\GameBundle\Entity\Game;
use Game\GameBundle\Entity\Repository\GameRepository;
use Game\ItemBundle\Manager\ItemManager;
use Game\MapBundle\Entity\LinkedPoi;
use Game\MapBundle\Entity\Map;
use Game\MapBundle\Entity\Path;
use Game\MapBundle\Entity\Poi;
use Game\MapBundle\Entity\RestPoint;
use Game\MapBundle\Entity\Treasure;
use Game\MonsterBundle\Entity\Spawn;
use Game\MonsterBundle\Manager\MonsterManager;
use Game\ShopBundle\Entity\Shop;
use Game\ShopBundle\Entity\ShopItem;

class GameCreatorManager extends CoreManager
{
    private $references = array();

    /** @var MonsterManager */
    protected $monsterManager;

    /** @var RollManager */
    protected $rollManager;

    /** @var ItemManager */
    protected $itemManager;

    /**
     * @return GameRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @param RollManager $rollManager
     */
    public function setRollManager($rollManager)
    {
        $this->rollManager = $rollManager;
    }

    /**
     * @param ItemManager $itemManager
     */
    public function setItemManager($itemManager)
    {
        $this->itemManager = $itemManager;
    }

    /**
     * @param MonsterManager $monsterManager
     */
    public function setMonsterManager($monsterManager)
    {
        $this->monsterManager = $monsterManager;
    }

    /**
     * @param $name
     * @return Game
     */
    public function createGame($name)
    {
        if (empty($name)) {
            $name = 'Game '.date('Ymd_His');
        }

        $game = new Game();
        $game->setName($name);
        $game->setStatus(Game::STATUS_IN_PROGRESS);
        $game->setStart(new \DateTime());
        $this->persist($game);

        $boss = $this->createBoss($game);
        $game->setBoss($boss);
        $this->createMap($game);
        $this->createTreasures($game);
        $this->createSpawns($game);
        $this->createShops($game);

        $this->flush();
        return $game;
    }

    /**
     * @param $game
     * @param string $name
     * @param string $image
     * @param int $hp
     * @return Boss
     */
    private function createBoss($game, $name = 'Kyrien', $image = 'boss_s1.jpg', $hp = 1000)
    {
        $boss = new Boss();
        $boss->setName($name);
        $boss->setImage($image);
        $boss->setCurrentHp($hp);
        $boss->setMaxHP($hp);
        $boss->setGame($game);
        $this->persist($boss);
        return $boss;
    }

    /**
     * @param $game
     */
    private function createMap($game)
    {
        //mapas
        $map = new Map();
        $map->setName('World map');
        $map->setFilename('map.png');
        $map->setGame($game);
        $this->persist($map);

        $dungeon = new Map();
        $dungeon->setName('Ruined tower dungeon');
        $dungeon->setFilename('dungeon1.jpg');
        $dungeon->setGame($game);
        $this->persist($dungeon);

        //pois
        $data = array();
        $data[0] = array('Wyvernstone', 145, 620, $map, true);
        $data[1] = array("Shadewood's crossroad", 278, 554, $map, false);
        $data[2] = array('Addelost', 304, 507, $map, false);
        $data[3] = array('Tibby', 312, 619, $map, false, false);
        $data[4] = array('Southward Keep', 366, 663, $map, false);
        $data[5] = array('Elmswell', 460, 588, $map, false);
        $data[6] = array('Shadewood', 344, 562, $map, false);
        $data[7] = array('Ruined tower', 205, 527, $map, false);

        $data[8] = array('Entrance', 483, 534, $dungeon, false);
        $data[9] = array('Large room', 516, 422, $dungeon, false);
        $data[10] = array('Room', 498, 211, $dungeon, false);//
        $data[11] = array('Large room', 456, 422, $dungeon, false);
        $data[12] = array('Room', 390, 254, $dungeon, false);//
        $data[13] = array('Strange room', 296, 422, $dungeon, false);//

        $out = array();
        foreach ($data as $poi) {
            $aux = new Poi();
            $aux->setName($poi[0]);
            $aux->setX($poi[1]);
            $aux->setY($poi[2]);
            $aux->setMap($poi[3]);
            $aux->setStartPoint($poi[4]);
            $this->persist($aux);
            $out[] = $aux;
        }

        //paths (para los 2 lados)
        $paths = array();
        $paths[] = array(0, 1);
        $paths[] = array(0, 7);
        $paths[] = array(1, 2);
        $paths[] = array(1, 3);
        $paths[] = array(1, 6);
        $paths[] = array(1, 7);
        $paths[] = array(2, 5);
        $paths[] = array(2, 6);
        $paths[] = array(2, 7);
        $paths[] = array(3, 4);
        $paths[] = array(3, 5);
        $paths[] = array(4, 5);

        $paths[] = array(8, 9);
        $paths[] = array(8, 11);
        $paths[] = array(9, 10);
        $paths[] = array(11, 12);
        $paths[] = array(12, 13);

        foreach ($paths as $path) {
            $aux = new Path();
            $aux->setDanger(10.0);
            $aux->setStart($out[$path[0]]);
            $aux->setEnd($out[$path[1]]);
            $this->persist($aux);

            $aux = new Path();
            $aux->setDanger(10.0);
            $aux->setStart($out[$path[1]]);
            $aux->setEnd($out[$path[0]]);
            $this->persist($aux);
        }

        //link entre mapas
        $linkeds = array();
        $linkeds[] = array("Entrance to the dungeon", 7, 8);
        $linkeds[] = array("Exit from the dungeon", 8, 7);

        foreach ($linkeds as $linked) {
            $aux = new LinkedPoi();
            $aux->setName($linked[0]);
            $aux->setStart($out[$linked[1]]);
            $aux->setEnd($out[$linked[2]]);
            $this->persist($aux);
        }

        $this->addReference('poi-start', $out[0]);
        $this->addReference('poi-city', $out[2]);

        //añadimos restpoints
        $restPoints = array();
        $restPoints[] = array('Local inn', RestPoint::REST_POINT_TYPE_INN, 5, $out[2]);
        $restPoints[] = array('Safe place in the ruined tower', RestPoint::REST_POINT_TYPE_SAFE_PLACE, 10, $out[7]);

        foreach ($restPoints as $restPoint) {
            $aux = new RestPoint();
            $aux->setName($restPoint[0]);
            $aux->setType($restPoint[1]);
            switch ($restPoint[1]) {
                case RestPoint::REST_POINT_TYPE_INN:
                    $aux->setCost($restPoint[2]);
                    break;
                case RestPoint::REST_POINT_TYPE_SAFE_PLACE:
                    $aux->setDanger($restPoint[2]);
                    break;
            }
            $aux->setPoi($restPoint[3]);
            $this->persist($aux);
        }

        // Añadimos todos los Poi's menos el inicial
        for ($i=1; $i<count($out); $i++) {
            $this->addReference('poi#' . ($i-1), $out[$i]);
        }
    }

    /**
     * @param $game
     */
    private function createTreasures($game)
    {
        $treasures = array(
            array('500', 'poi#12')
        );

        foreach ($treasures as $treasureInfo) {
            $treasure = new Treasure();
            $treasure->setGold($treasureInfo[0]);
            $treasure->setPoi($this->getReference($treasureInfo[1]));
            $this->persist($treasure);
        }
    }

    /**
     * @param $game
     */
    private function createSpawns($game)
    {
        $monsterList  = array('orc_1', 'shadow_1', 'lich_1');
        $poiCount = 6; //Hard-code del numero de Poi's sin contar el inicial

        $insertKeys = array();

        for ($i = 0; $i < 15; $i++) {
            $monster = $this->monsterManager->getMonsterByInternalName($monsterList[mt_rand(0, count($monsterList)-1)]);
            $poi = $this->getReference('poi#' . mt_rand(0, $poiCount));
            $key = $monster->getId() . ' - ' . $poi->getId();

            if (in_array($key, $insertKeys)) {
                continue;
            }

            $insertKeys[] = $key;

            $aux = new Spawn();
            $aux
                ->setMonster($monster)
                ->setPoi($poi)
                ->setRate(mt_rand(0, 75))
                ->setMin(1)
                ->setMax(mt_rand(1, 4));

            $this->persist($aux);
        }
    }

    private function createShops($game)
    {
        $shop = new Shop();
        $shop->setName("Blacksmith");
        $shop->setBuyDecrement(10);
        $shop->setSellIncrement(15);
        $shop->setPoi($this->getReference('poi-city'));
        $this->persist($shop);

        $items = array(
            //weapons
            'Dagger', 'Short sword', 'Long sword', 'Handaxe',
            'Greatsword', 'Heavy flail', 'Lance', 'Longbow',
            //armors
            'Leather', 'Mail', 'Plated', 'Full plated',
            //potions
            'Potion of health'
        );

        foreach ($items as $itemRef) {
            $item = new ShopItem();
            $item->setShop($shop);
            $item->setItem($this->itemManager->getItemByName($itemRef));
            $this->persist($item);
        }
    }


    /**
     * @param $key
     * @param $value
     */
    private function addReference($key, $value)
    {
        $this->references[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    private function getReference($key)
    {
        return $this->references[$key];
    }
}
