<?php


namespace App\Domain\UseCases\PlayerTurn;


use App\Domain\Repositories\BoardRepository;

class PlayerTurn
{
    public function __construct(private BoardRepository $repository)
    {
    }

    public function execute(PlayerTurnInputData $inputData): PlayerTurnOutputData
    {
        $board = $this->repository->get($inputData->getBoardId());
        $board->fillCell($inputData->getX(), $inputData->getY());
        $winner = $board->checkMatchResult();
        return new PlayerTurnOutputData($board->getId(), $winner);
    }
}