<?php

namespace App\Adapters\Repositories;

use App\Domain\Entities\Board;
use App\Domain\Exceptions\EntityNotFoundException;
use App\Domain\Repositories\BoardRepository;

class BoardMemoryRepository implements BoardRepository
{
    private $boards = [];

    function all(): array
    {
        return $this->boards;
    }

    function get(int $id): Board
    {
        $board = array_filter(
                $this->boards,
                function (Board $board) use ($id) {
                    return $board->getId() == $id;
                }
            )[0] ?? null;
        if (!$board) {
            throw new EntityNotFoundException('Board');
        }
        return $board;
    }

    function create(Board $board): Board
    {
        if ($board->getId()) {
            throw new \Exception('Board already exists');
        }
        $lastBoard = end($this->boards);
        $id = 1;
        if ($lastBoard) {
            $id = $lastBoard->getId() + 1;
        }
        $board->setId($id);
        $this->boards[] = $board;
        return $board;
    }

    function update(Board $board): Board
    {
        $this->get($board->getId());
        $foundKey = $this->findKey($board);
        $this->boards[$foundKey] = $board;
        return $board;
    }

    function delete(int $id): void
    {
        $board = $this->get($id);
        $key = $this->findKey($board);
        unset($this->boards[$key]);
    }

    private function findKey(Board $board): int
    {
        foreach ($this->boards as $key => $savedBoard) {
            if ($savedBoard->getId() === $board->getId()) {
                return $key;
            }
        }
        throw new EntityNotFoundException('Board');
    }
}
