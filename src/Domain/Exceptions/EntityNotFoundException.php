<?php


namespace App\Domain\Exceptions;


class EntityNotFoundException extends \Exception
{

    /**
     * FilledCellException constructor.
     */
    public function __construct($entityName = "", $code = 0, \Throwable $previous = null)
    {
        $message = $entityName . ' not found.';
        parent::__construct($message, $code, $previous);
    }
}