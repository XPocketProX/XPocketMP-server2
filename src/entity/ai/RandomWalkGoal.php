<?php

namespace pocketmine\entity\ai;

use pocketmine\entity\Living;
use pocketmine\math\Vector3;

class RandomWalkGoal extends Goal {

    private Living $entity;
    private int $walkRadius;
    private int $cooldown = 0;
    private int $cooldownMax = 100;

    public function __construct(Living $entity, int $walkRadius = 10) {
        $this->entity = $entity;
        $this->walkRadius = $walkRadius;
    }

    public function shouldExecute() : bool {
        return $this->cooldown <= 0;
    }

    public function start() : void {
        $randomPosition = $this->getRandomPosition();
        $motion = $randomPosition->subtract(
            $this->entity->getPosition()->x,
            $this->entity->getPosition()->y,
            $this->entity->getPosition()->z
        )->normalize()->multiply(0.2);
        $this->entity->setMotion($motion);
        $this->cooldown = $this->cooldownMax;
    }

    public function tick() : void {
        if ($this->cooldown > 0) {
            $this->cooldown--;
        }
    }

    private function getRandomPosition() : Vector3 {
        $x = $this->entity->getPosition()->x + mt_rand(-$this->walkRadius, $this->walkRadius);
        $z = $this->entity->getPosition()->z + mt_rand(-$this->walkRadius, $this->walkRadius);
        $y = $this->entity->getWorld()->getHighestBlockAt((int)$x, (int)$z);
        return new Vector3($x, $y, $z);
    }
}
