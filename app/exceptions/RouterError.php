<?php

namespace exceptions;

class RouterError extends BaseError
{
    const UNKNOWN_ROUTER = 1;

    public static function getErrorMessage(int $code, string $additionalMessage): string
    {
        $message = self::UNKNOWN_ERROR_MSG;

        switch ($code) {
            case self::UNKNOWN_ROUTER:
                $message = "Не удалось определить роутер для криложения класса $additionalMessage";
        }

        return $message;
    }
}