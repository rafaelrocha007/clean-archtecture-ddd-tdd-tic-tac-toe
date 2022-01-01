<?php


namespace App\Domain\Exceptions;


class FilledCellException extends \Exception
{

    /**
     * FilledCellException constructor.
     */
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}