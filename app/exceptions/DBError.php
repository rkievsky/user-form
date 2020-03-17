<?php

namespace exceptions;

class DBError extends BasicError
{
    const UNKNOWN_DRIVER = 'Неизвестный драйвер';

    public static function getErrorMessage(int $code, string $additionalMessage): string
    {
        $message = self::UNKNOWN_ERROR_MSG;

        switch ($code) {
            case self::UNKNOWN_DRIVER:
                $message = "Нет драйвера для алиаса $additionalMessage";
        }

        return $message;
    }
}