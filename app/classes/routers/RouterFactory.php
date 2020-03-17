<?php

namespace classes\routers;

class RouterFactory
{
    /**
     * Фабричынй метод создания роутеров
     *
     * @param bool $isWeb
     */
    public static function create(bool $isWeb) : IRouter
    {
        if ($isWeb) {
            $className = WebRouter::class;
        } else {
            $className=  ConsoleRouter::class;
        }

        return new $className;
    }
}