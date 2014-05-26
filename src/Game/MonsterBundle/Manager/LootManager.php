<?php

namespace Game\MonsterBundle\Manager;

use Game\BattleBundle\Model\BattleResult;
use Game\CharacterBundle\Entity\Character;
use Game\CharacterBundle\Entity\CharacterItem;
use Game\CoreBundle\Manager\CoreManager;
use Game\MonsterBundle\Entity\Monster;
use Game\MonsterBundle\Entity\Repository\LootTableRepository;
use Game\MonsterBundle\Model\Loot;

class LootManager extends CoreManager
{
    const LOOT_CHANCE_GOLD = 20;

    const LOOT_CHANCE_ITEM_DECREMENT = 5;

    /**
     * @return LootTableRepository
     */
    protected function getRepository()
    {
        return parent::getRepository();
    }


    /**
     * @param BattleResult $battleResult
     * @return Loot
     */
    public function generateBattleLoot(BattleResult $battleResult)
    {
        $loot = new Loot();
        $battleMonsters = $battleResult->getMonstersKilled();
        if (count($battleMonsters) > 0) {
            foreach ($battleMonsters as $battleMonster) {
                $loot->addLoot($this->generateLoot($battleMonster->getPlayer()));
            }
        }
        return $loot;
    }

    /**
     * Genera el loot
     * - hay un % de posibilidades de generar oro
     * - según el item tiene un % de dropear, que se va incrementando
     *
     * @param Monster $monster
     * @return Loot
     */
    public function generateLoot($monster)
    {
        $loot = new Loot();
        $lootTable = $monster->getLootTable();

        //oro
        if (rand(1, 100) <= self::LOOT_CHANCE_GOLD) {
            $loot->setGold(rand($lootTable->getGoldMin(), $lootTable->getGoldMax()));
        }

        //items
        $lootItems = $lootTable->getLootItems()->toArray();
        shuffle($lootItems);
        if ($lootItems) {
            $decrement = 0;
            foreach ($lootItems as $lootItem) {
                $chance = $lootItem->getChance() - $decrement;
                //si el decremento de posibilidades es mayor a 100% me salgo
                if ($decrement>= 100) {
                    break;
                }
                //solo sigo si hay alguna posibilidad
                if ($chance > 0) {
                    if (rand(1, 100) <= $chance) {
                        $loot->addItem($lootItem->getItem());
                        $decrement += self::LOOT_CHANCE_ITEM_DECREMENT;
                    }
                }
            }
        }
        return $loot;
    }

    /**
     * @param Character $char
     * @param Loot $loot
     */
    public function giveTo(Character $char, Loot $loot)
    {
        //oro
        $char->addGold($loot->getGold());
        $this->persist($char);

        //items
        $lootItems = $loot->getItems();
        if (count($lootItems)>0) {
            foreach ($lootItems as $lootItem) {
                $charItem = new CharacterItem();
                $charItem->setItem($lootItem);
                $charItem->setCharacter($char);
                $this->persist($charItem);
            }
        }
    }

    /**
     * @param $lootLog
     * @return Loot
     */
    public function lootLogTransformer($lootLog)
    {
        $loot = new Loot();
        $lootDecoded = json_decode($lootLog, true);
        $repo = $this->em->getRepository('ItemBundle:Item');

        $loot->setGold($lootDecoded['gold']);

        foreach ($lootDecoded['items'] as $itemId) {
            $item = $repo->findOneById($itemId);
            $loot->addItem($item);
        }

        return $loot;
    }
} 