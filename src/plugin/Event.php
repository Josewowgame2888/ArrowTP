<?php

namespace plugin;

use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\event\Listener;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\Player;

class Event implements Listener
{
    public function __construct()
    {
        Loader::getInstance()->getServer()->getPluginManager()->registerEvents($this,Loader::getInstance());
    }

    public function onLaunch(ProjectileLaunchEvent $event): void
    {
        $entity =  $event->getEntity();
        $player = $entity->getOwningEntity();
        if($entity instanceof Arrow && $player instanceof Player) {
            $entity->setOwner($player);
            $pk = new PlaySoundPacket();
            $pk->soundName = 'mob.endermen.portal';
            $pk->volume = 1;
            $pk->pitch = 1;
            $pk->x = $player->x;
            $pk->y = $player->y;
            $pk->z = $player->z;
            $player->dataPacket($pk);
        }
    }

    public function onHit(ProjectileHitEvent $event): void
    {
        $entity = $event->getEntity();
        if($entity instanceof Arrow) {
            $entity->owner = null;
        }
    }
}