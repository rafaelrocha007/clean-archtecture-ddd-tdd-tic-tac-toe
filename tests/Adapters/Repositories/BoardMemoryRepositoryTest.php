<?php

use App\Adapters\Repositories\BoardMemoryRepository;
use App\Domain\UseCases\CreateBoard\CreateBoard;

use function PHPUnit\Framework\assertCount;

it(
    'should throw trying to find an unexistent board',
    function () {
        $sut = new BoardMemoryRepository();
        $sut->get(1);
    }
)->throws(Exception::class);

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
