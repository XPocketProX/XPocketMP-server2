<?php

namespace pocketmine\entity\ai;

abstract class Goal {

    /**
     * Determine whether AI should be run.
     * @return bool
     */
    public abstract function shouldExecute() : bool;

    /**
     * Start AI execution.
     * This will be called when `shouldExecute()` returns true.
     */
    public abstract function start() : void;

    /**
     * Run every tick to update the AI behavior.
     */
    public function tick() : void {
        // Can be implemented in subclasses, if needed for each tick
    }

    /**
     * Stop AI execution (e.g., when target is lost or AI is finished).
     */
    public function stop() : void {
        // To stop AI actions, it can be overwritten in derived classes.
    }
}
