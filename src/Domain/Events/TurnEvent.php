<?php

namespace App\Domain\Events;

class TurnEvent
{
    public function __construct(private string $player, private int $x, private int $y)
    {
    }

    /**
     * @return string
     */
    public function getPlayer(): string
    {
        return $this->player;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }
}