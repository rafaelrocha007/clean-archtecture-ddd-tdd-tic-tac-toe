<?php

use App\Infra\FileDriver\FileDriver;

use function PHPUnit\Framework\assertEquals;

it(
    'should write and read from file',
    function () {
        $filePath = 'tests/boards.serialized.test.txt';
        $sut = new FileDriver($filePath);
        $sut->write("any_content");
        assertEquals($sut->read(), "any_content");
        unlink($filePath);
    }
);