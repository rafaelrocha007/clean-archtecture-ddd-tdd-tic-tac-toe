<?php


namespace App\Domain\UseCases\CreateBoard;


use App\Domain\Entities\Board;
use App\Domain\Repositories\BoardRepository;

class CreateBoard
{
    public function __construct(private BoardRepository $repository)
    {
    }

    public function execute(): CreateBoardOutputData
    {
        $board = new Board(null);
        $board = $this->repository->create($board);
        return new CreateBoardOutputData($board->getId());
    }
}