<?php

use App\Adapters\Repositories\BoardMemoryRepository;
use App\Domain\Repositories\BoardRepository;
use App\Domain\UseCases\CreateBoard\CreateBoard;

use function PHPUnit\Framework\assertEquals;

function createSut(): CreateBoard
{
    return new CreateBoard(createRepository());
}

function createRepository(): BoardRepository
{
    return new BoardMemoryRepository();
}

it(
    'Should create a game Board',
    function () {
        $sut = createSut();
        $board1 = $sut->execute();
        assertEquals($board1->getBoardId(), 1);
        $board2 = $sut->execute();
        assertEquals($board2->getBoardId(), 2);
    }
);
