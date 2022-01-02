<?php


namespace App\Domain\Repositories;


use App\Domain\Entities\Board;

interface BoardRepository
{
    function all(): array;

    function get(int $id): Board;

    function create(Board $board): Board;

    function update(Board $board): Board;

    function delete(int $id): void;
}