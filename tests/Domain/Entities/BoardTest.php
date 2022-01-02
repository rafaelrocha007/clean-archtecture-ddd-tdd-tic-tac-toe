<?php

use App\Domain\Entities\Board;
use App\Domain\Exceptions\FilledCellException;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

it(
    'should throw trying to fill a filled cell',
    function () {
        $sut = new Board();
        $sut->fillCell(0, 0);
        $sut->fillCell(0, 0);
    }
)->throws(FilledCellException::class);

it(
    'should starts with X player',
    function () {
        $sut = new Board();
        assertEquals($sut->getCurrentPlayer(), 'x');
    }
);

it(
    'should fill a cell',
    function () {
        $sut = new Board();
        $sut->fillCell(0, 0);
        assertEquals($sut->getCellValue(0, 0), 'x');
    }
);

it(
    'should change turn when a cell is filled',
    function () {
        $sut = new Board();
        $sut->fillCell(0, 0);
        assertEquals($sut->getCurrentPlayer(), 'o');
    }
);

it(
    'should player x win the match',
    function () {
        $sut = new Board();
        $sut->fillCell(0, 0);
        $sut->fillCell(1, 0);
        $sut->fillCell(0, 1);
        $sut->fillCell(1, 1);
        $sut->fillCell(0, 2);
        assertEquals($sut->checkMatchResult(), 'x');
    }
);

it(
    'should player x win the match in column',
    function () {
        $sut = new Board();
        $sut->fillCell(0, 0);
        $sut->fillCell(0, 1);
        $sut->fillCell(1, 0);
        $sut->fillCell(1, 1);
        $sut->fillCell(2, 0);
        assertEquals($sut->checkMatchResult(), 'x');
    }
);

it(
    'should player x win the match in diagonals',
    function () {
        $sut = new Board();
        $sut->fillCell(0, 0);
        $sut->fillCell(0, 1);
        $sut->fillCell(1, 1);
        $sut->fillCell(1, 2);
        $sut->fillCell(2, 2);
        assertEquals($sut->checkMatchResult(), 'x');
    }
);

it(
    'should player o win the match',
    function () {
        $sut = new Board();
        $sut->fillCell(0, 0);
        $sut->fillCell(1, 0);
        $sut->fillCell(0, 1);
        $sut->fillCell(1, 1);
        $sut->fillCell(0, 2);
        assertEquals($sut->checkMatchResult(), 'x');
    }
);

it(
    'should tie the match',
    function () {
        $sut = new Board();
        $sut->fillCell(0, 0);
        $sut->fillCell(0, 2);
        $sut->fillCell(0, 1);
        $sut->fillCell(1, 0);
        $sut->fillCell(1, 2);
        $sut->fillCell(1, 1);
        $sut->fillCell(2, 0);
        $sut->fillCell(2, 2);
        $sut->fillCell(2, 1);
        assertEquals($sut->checkMatchResult(), 'tie');
    }
);

it(
    'should return null while not all cells are filled',
    function () {
        $sut = new Board();
        $sut->fillCell(0, 0);
        $sut->fillCell(1, 0);
        assertNull($sut->checkMatchResult());
    }
);
