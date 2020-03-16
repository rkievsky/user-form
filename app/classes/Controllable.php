<?php

namespace classes;

trait Controllable
{
    protected $config = [];

    protected function loadConfig(string $configName)
    {
        $this->config = require $configName;
    }

    public function getConfig(string $key, $defaultValue = null)
    {
        return $this->config[$key] ?? $defaultValue;
    }

    public function setConfig(string $key, $value)
    {
        $this->config[$key] = $value;
    }
}