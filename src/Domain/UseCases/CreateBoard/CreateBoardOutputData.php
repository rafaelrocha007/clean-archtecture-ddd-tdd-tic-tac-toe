<?php


namespace App\Domain\UseCases\CreateBoard;


class CreateBoardOutputData
{
    public function __construct(private int $boardId)
    {
    }

    /**
     * @return int
     */
    public function getBoardId(): int
    {
        return $this->boardId;
    }
}
