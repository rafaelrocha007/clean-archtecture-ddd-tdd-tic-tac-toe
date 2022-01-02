<?php

use App\Adapters\Repositories\BoardMemoryRepository;
use App\Domain\UseCases\CreateBoard\CreateBoard;

use function PHPUnit\Framework\assertEquals;

it(
    'should create a game Board',
    function () {
        $sut = new CreateBoard(new BoardMemoryRepository());
        $board1 = $sut->execute();
        assertEquals($board1->getBoardId(), 1);
        $board2 = $sut->execute();
        assertEquals($board2->getBoardId(), 2);
    }
);
