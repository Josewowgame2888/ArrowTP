<?php

namespace plugin;

use pocketmine\entity\Entity;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase
{
    /** @var Loader */
    private static $instance;

    public function onEnable(): void
    {
        static::$instance = $this;
        Entity::registerEntity(Arrow::class,true);
        new Event();
        $this->getServer()->getLogger()->info('ArrowTP enable by @Josewowgame!');
    }

    public static function getInstance(): self
    {
        return static::$instance;
    }
}