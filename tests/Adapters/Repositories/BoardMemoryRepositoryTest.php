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
