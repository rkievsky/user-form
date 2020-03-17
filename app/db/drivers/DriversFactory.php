<?php

use exceptions\DBError;

class DriversFactory
{
    /**
     * @param $driverName
     *
     * @return IDBDriver
     *
     * @throws \exceptions\BasicError
     */
    public static function create(array $config) : IDBDriver
    {
        switch (strtolower($config['driver'])) {
            case 'mariadb':
            case 'mysql':
                return new MySQLDriver($config);
                break;
            default:
                throw DBError::create(DBError::UNKNOWN_DRIVER, $config['driver']);
        }
    }
}