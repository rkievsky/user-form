<?php

namespace classes\app;

use classes\Controllable;
use classes\routers\RouterFabric;

abstract class BasicApplication
{
    use Controllable;

    const APP_CONFIGS_PATH = 'configs/';

    /** @var WebApplication $app */
    private static $app = null;

    protected function getBaseConfigName()
    {
        return
            APP_ROOT . DIRECTORY_SEPARATOR
            . self::APP_CONFIGS_PATH . DIRECTORY_SEPARATOR
            . 'env.php';
    }

    public static function create() : BasicApplication
    {
        if (self::$app) {
            return self::$app;
        }

        self::$app = new static();

        return self::$app;
    }

    public function __construct()
    {
        $this->loadConfig($this->getBaseConfigName());
    }

    public function run()
    {
        try {
            $router = RouterFabric::create(static::class);

        } catch (\Throwable $error) {

        }
    }
}