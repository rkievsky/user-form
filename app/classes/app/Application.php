<?php

namespace classes\app;

use classes\Controllable;
use classes\routers\RouterFactory;

abstract class Application
{
    use Controllable;

    const APP_CONFIGS_PATH = 'configs/';

    /** @var Application $app */
    private static $app = null;

    private $isWeb = true;

    protected function getBaseConfigName()
    {
        return
            APP_ROOT . DIRECTORY_SEPARATOR
            . self::APP_CONFIGS_PATH . DIRECTORY_SEPARATOR
            . 'env.php';
    }

    public function isWeb()
    {
        return $this->isWeb;
    }

    public static function create($isWeb = true) : Application
    {
        if (self::$app) {
            return self::$app;
        }

        self::$app = new static($isWeb);

        return self::$app;
    }

    public static function get() : Application
    {
        return self::$app;
    }

    public function __construct($isWeb = true)
    {
        $this->isWeb = $isWeb;
        $this->loadConfig($this->getBaseConfigName());
    }

    public function run() : int
    {
        $router = RouterFactory::create($this->isWeb());
        $controller = $router->getController();
        $method = $router->getMethod();

    }

}