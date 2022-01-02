<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Exceptions\FilledCellException;

class Board
{
    private $currentPlayer = 'x';

    public function __construct(
        private ?int $id = null,
        private array $board = [
            [null, null, null],
            [null, null, null],
            [null, null, null],
        ],
        private array $events = []
    ) {
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function fillCell(int $x, int $y)
    {
        if ($this->board[$x][$y] !== null) {
            throw new FilledCellException("Cell $x, $y is already filled.");
        }
        $this->board[$x][$y] = $this->currentPlayer;
        $this->changeTurn();
    }

    private function changeTurn()
    {
        if ($this->currentPlayer === 'x') {
            $this->currentPlayer = 'o';
        } else {
            $this->currentPlayer = 'x';
        }
    }

    public function checkMatchResult()
    {
        $winner = $this->checkWinner();
        if ($winner !== null) {
            return $winner;
        }
        $tie = $this->checkTie();
        if ($tie !== null) {
            return $tie;
        }
        return null;
    }

    /**
     * @return mixed|null
     *
     * Will return x or o for the winner or null with no winner
     */
    private function checkWinner(): ?string
    {
        foreach ($this->board as $column => $line) {
            $winnerInLine = $this->checkWinnerLine($line);
            if ($winnerInLine) {
                return $winnerInLine;
            }
            $winnerInColumn = $this->checkWinnerColumn($column);
            if ($winnerInColumn) {
                return $winnerInColumn;
            }
        }
        $winner = $this->checkWinnerDiagonals();
        if ($winner !== null) {
            return $winner;
        }
        return null;
    }

    private function checkWinnerLine($line): ?string
    {
        if (count(array_unique($line)) === 1) {
            return $line[0];
        }
        return null;
    }

    private function checkWinnerColumn($columnIndex): ?string
    {
        if (count(
                array_unique(
                    [
                        $this->board[0][$columnIndex],
                        $this->board[1][$columnIndex],
                        $this->board[2][$columnIndex],
                    ]
                )
            ) === 1) {
            return $this->board[0][$columnIndex];
        }
        return null;
    }

    private function checkWinnerDiagonals()
    {
        // In both diagonals the winner will touch the 1,1 position in the board
        $winner = $this->board[1][1];
        if (count(
                array_unique(
                    [
                        $this->board[0][0],
                        $this->board[1][1],
                        $this->board[2][2],
                    ]
                )
            ) === 1) {
            return $winner;
        }
        if (count(
                array_unique(
                    [
                        $this->board[0][2],
                        $this->board[1][1],
                        $this->board[2][0],
                    ]
                )
            ) === 1) {
            return $winner;
        }
        return null;
    }

    private function checkTie(): ?string
    {
        foreach ($this->board as $line) {
            foreach ($line as $cell) {
                if ($cell === null) {
                    return null;
                }
            }
        }
        return 'tie';
    }

    /**
     * @return string
     */
    public function getCurrentPlayer(): string
    {
        return $this->currentPlayer;
    }

    /**
     * @return string
     */
    public function getCellValue(int $x, int $y): string
    {
        return $this->board[$x][$y];
    }
}
