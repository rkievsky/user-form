<?php

return [
    'APP_ENV' => 'production',
    'HOST_NAME' => 'test-task.local',
    'DB' => [
        'driver'   => 'mysql',
        'host'     => 'mysql',
        'port'     => 3306,
        'dbname'   => 'test_task_db',
        'user'     => 'root',
        'password' => '123',
        'charset' => 'utf8',
        'options'  => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ],
    ],
];