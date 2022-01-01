<?php

use App\Domain\Entities\Board;
use App\Domain\Exceptions\FilledCellException;

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
    'Should fill a cell',
    function () {
        $sut = makeSut();
        $sut->fillCell(0,0);
    }
);