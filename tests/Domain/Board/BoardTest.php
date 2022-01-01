<?php

use App\Domain\Entities\Board;
use App\Domain\Exceptions\FilledCellException;

use function PHPUnit\Framework\assertEquals;

function makeSut()
{
    return new Board();
}

it(
    'Should throw trying to fill a filled cell',
    function () {
        $sut = makeSut();
        $sut->fillCell(0, 0);
        $sut->fillCell(0, 0);
    }
)->throws(FilledCellException::class);

it(
    'Should starts with X player',
    function () {
        $sut = makeSut();
        assertEquals($sut->getCurrentPlayer(), 'x');
    }
);

