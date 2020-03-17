<?php

interface IDBDriver
{
    public function __construct(array $config);

    public function query();

    public function execute();
}