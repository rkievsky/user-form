<?php

use classes\Controllable;

class MySQLDriver implements IDBDriver
{
    use Controllable;

    private function getDSN()
    {
        return sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            $this->getConfig('host'),
            $this->getConfig('port'),
            $this->getConfig('dbname', ''),
            $this->getConfig('charset', ''),
        );
    }

    public function __construct(array $config)
    {
        $this->config = $config;
    }
}