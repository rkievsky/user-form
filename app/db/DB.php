<?php

use classes\app\Application;

class DB
{
    /** @var IDBDriver $driver  */
    private static $driver = null;

    /**
     * @throws \exceptions\BasicError
     */
    private static function getDriver()
    {
        if (!self::$driver) {
            self::$driver = DriversFactory::create(Application::get()->getConfig('DB'));
        }

        return self::$driver;
    }

    /**
     * @param $method
     * @param $arguments
     *
     * @throws \exceptions\BasicError
     */
    public static function __callStatic($method, $arguments)
    {
         return self::getDriver()->$method(...$arguments);
    }
}