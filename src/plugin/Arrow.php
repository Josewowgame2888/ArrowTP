<?php

declare(strict_types=1);

namespace plugin;

use pocketmine\entity\projectile\Arrow as ArrowEntity;
use pocketmine\level\particle\FlameParticle;
use pocketmine\math\Vector3;
use pocketmine\Player;

class Arrow extends ArrowEntity
{
    /** @var Player */
    public $owner;

    public function setOwner(Player $player): void
    {
        $this->owner = $player;
    }

    public function getVectorArrow(): Vector3
    {
        return new Vector3($this->x-2,$this->y+2,$this->z+2);
    }

    public function entityBaseTick(int $tickDiff = 1): bool
    {
        $return = parent::entityBaseTick(1);
        if(!is_null($this->owner)) {
            if($this->owner instanceof Player) {
                if(!$this->owner->isClosed()) {
                    $this->owner->teleport($this->getVectorArrow());
                    $this->getLevel()->addParticle(new FlameParticle(new Vector3($this->x,$this->y,$this->z)));
                } else {
                    $this->owner = null;
                }

            }
        } else {
            $this->close();
        }
        return $return;
    }
}