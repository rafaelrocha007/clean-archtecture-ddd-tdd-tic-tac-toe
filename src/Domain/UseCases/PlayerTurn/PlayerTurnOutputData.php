<?php


namespace App\Domain\UseCases\PlayerTurn;


class PlayerTurnOutputData
{
    public function __construct(
        private int $boardId,
        private ?string $winner,
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
     * @return string
     */
    public function getWinner(): string
    {
        return $this->winner;
    }
}
