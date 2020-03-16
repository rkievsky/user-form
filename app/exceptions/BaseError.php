<?php

namespace exceptions;

abstract class BaseError extends \Exception
{
    const UNKNOWN_ERROR_MSG = 'Неизвестная ошибка';
    const UNKNOWN_ERROR_CODE = 0;

    abstract public static function getErrorMessage(int $code, string $additionalMessage) : string;

    /**
     * @param int             $code
     * @param string          $additionalMessage
     * @param \Throwable|null $prevError
     * @return static
     */
    public static function create(int $code, string $additionalMessage = '', \Throwable $prevError = null)
    {
        return new static($code, static::getErrorMessage($code, $additionalMessage), $prevError);
    }
}