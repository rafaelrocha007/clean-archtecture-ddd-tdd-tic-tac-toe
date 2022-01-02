<?php

use App\Adapters\Repositories\BoardMemoryRepository;
use App\Domain\UseCases\CreateBoard\CreateBoard;
use App\Domain\UseCases\PlayerTurn\PlayerTurn;
use App\Domain\UseCases\PlayerTurn\PlayerTurnInputData;

use function PHPUnit\Framework\assertEquals;

it(
    'should player plays your turn',
    function () {
        $repository = new BoardMemoryRepository();
        $createBoardUseCase = new CreateBoard($repository);
        $boardOutPutData = $createBoardUseCase->execute();
        assertEquals($boardOutPutData->getBoardId(), 1);
        $playerTurn = new PlayerTurn($repository);
        $playerTurnInputData = new PlayerTurnInputData($boardOutPutData->getBoardId(), 0, 0);
        $playerTurn->execute($playerTurnInputData);
    }
);

//it(
//    'should winner be null while match is not over',
//    function () {
//        $repository = new BoardMemoryRepository();
//        $createBoardUseCase = new CreateBoard($repository);
//        $boardOutPutData = $createBoardUseCase->execute();
//        assertEquals($boardOutPutData->getBoardId(), 1);
//        $playerTurn = new PlayerTurn($repository);
//        $playerTurnInputData = new PlayerTurnInputData($boardOutPutData->getBoardId(), 0, 0);
//        $playerTurn->execute($playerTurnInputData);
//    }
//);
