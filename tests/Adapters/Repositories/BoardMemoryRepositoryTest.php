<?php

use App\Adapters\Repositories\BoardMemoryRepository;
use App\Domain\UseCases\CreateBoard\CreateBoard;
use App\Domain\UseCases\PlayerTurn\PlayerTurn;
use App\Domain\UseCases\PlayerTurn\PlayerTurnInputData;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;

it(
    'should throw trying to find an unexistent board',
    function () {
        $sut = new BoardMemoryRepository();
        $sut->get(1);
    }
)->throws(Exception::class);

it(
    'should throw trying to create a board with the same id',
    function () {
        $sut = new BoardMemoryRepository();
        $createBoardUseCase = new CreateBoard($sut);
        $createBoardUseCaseOutPutData = $createBoardUseCase->execute();
        $board = $sut->get($createBoardUseCaseOutPutData->getBoardId());
        $sut->create($board);
    }
)->throws(Exception::class, 'Board already exists');

it(
    'should return all saved boards',
    function () {
        $sut = new BoardMemoryRepository();
        assertCount(0, $sut->all());
        $createBoardUseCase = new CreateBoard($sut);
        for ($i = 1; $i <= 5; $i++) {
            $createBoardUseCase->execute();
            assertCount($i, $sut->all());
        }
    }
);

it(
    'should update a board',
    function () {
        $sut = new BoardMemoryRepository();
        $createBoardUseCase = new CreateBoard($sut);
        assertCount(0, $sut->all());
        $createBoardOutputData = $createBoardUseCase->execute();
        $board = $sut->get($createBoardOutputData->getBoardId());
        assertEquals($board->getId(), 1);
        assertEquals($board->getCurrentPlayer(), 'x');
        $playerTurnUseCase = new PlayerTurn($sut);
        $playerTurnInputData = new PlayerTurnInputData($createBoardOutputData->getBoardId(), 0, 0);
        $playerTurnOutputData = $playerTurnUseCase->execute($playerTurnInputData);
        assertEquals($playerTurnOutputData->getBoardId(), $board->getId());
        $updatedBoard = $sut->get($board->getId());
        assertEquals($updatedBoard->getCurrentPlayer(), 'o');
    }
);

it(
    'should delete a board',
    function () {
        $sut = new BoardMemoryRepository();
        assertCount(0, $sut->all());
        $createBoardUseCase = new CreateBoard($sut);
        $board1 = $createBoardUseCase->execute();
        $board2 = $createBoardUseCase->execute();
        assertCount(2, $sut->all());
        $sut->delete($board1->getBoardId());
        assertCount(1, $sut->all());
    }
);