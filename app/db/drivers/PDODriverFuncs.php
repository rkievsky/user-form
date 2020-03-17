<?php

namespace db\drivers;

trait PDODriverFuncs
{
    private $pdo = null;

    private function getPDO()
    {
        if (!$this->pdo) {
            $this->pdo = new \PDO(
                $this->getDSN(),
                $this->getConfig('user'),
                $this->getConfig('password'),
                $this->getConfig('options')
            );
        }

        return $this->pdo;
    }
}