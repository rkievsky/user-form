<?php

namespace exceptions;

class ControllerError extends BasicError
{
    const UNKNOWN_ACTION = 1;
    const UNKNOWN_ROUTE = 2;
    const INVALID_ACTION_PARAMS = 3;
    const INVALID_ACTION_PARAMS_TYPE = 3;

    public static function getErrorMessage(int $code, string $additionalMessage): string
    {
        $message = self::UNKNOWN_ERROR_MSG;

        switch ($code) {
            case self::UNKNOWN_ACTION:
                $message = "Нет метода контроллера для действия '$additionalMessage'";
                break;
            case self::UNKNOWN_ROUTE:
                $message = "Нет контроллера для роута '$additionalMessage'";
                break;
            case self::INVALID_ACTION_PARAMS:
                $message = "Некорректные параметры для действия '$additionalMessage'";
                break;
            case self::INVALID_ACTION_PARAMS_TYPE:
                $message = "Некорректный тип параметров для действия '$additionalMessage'";
                break;
        }

        return $message;
    }
}