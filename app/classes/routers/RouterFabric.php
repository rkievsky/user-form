<?php

namespace classes\routers;

use classes\app\ConsoleApplication;
use classes\app\WebApplication;
use exceptions\RouterError;

class RouterFabric
{
    /**
     * Фабричынй метод создания роутеров
     *
     * @param $appClass
     * @throws \exceptions\BaseError
     */
    public static function create($appClass) : IRouter
    {
        switch ($appClass) {
            case WebApplication::class:
                return self::createWebRouter();
                break;
            case ConsoleApplication::class:
                return self::createConsoleRouter();
                break;
            default:
                throw RouterError::create(RouterError::UNKNOWN_ROUTER, $appClass);
        }
    }

    public static function createWebRouter() : WebRouter
    {
        return new WebRouter();
    }

    public static function createConsoleRouter() : ConsoleRouter
    {
        return new ConsoleRouter();
    }

}