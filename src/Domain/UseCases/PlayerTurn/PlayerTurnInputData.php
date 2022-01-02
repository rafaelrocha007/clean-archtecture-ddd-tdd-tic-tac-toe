<?php


namespace App\Domain\UseCases\PlayerTurn;


class PlayerTurnInputData
{
    public function __construct(
        private int $boardId,
        private int $x,
        private int $y
    ) {
    }

    /**
     * @return int
     */
    public function getBoardId(): int
    {
        return $this->boardId;
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
