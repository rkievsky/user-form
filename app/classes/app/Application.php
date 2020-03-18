<?php

namespace classes\app;

use classes\Controllable;
use classes\routers\IRouter;
use classes\routers\RouterFactory;
use exceptions\ControllerError;
use models\requests\IWebRequest;

class Application
{
    use Controllable;

    const APP_CONFIGS_PATH = 'configs/';

    /** @var Application $app */
    private static $app = null;

    private $isWeb = true;

    /** @var IWebRequest $request */
    private $request;

    /** @var IRouter $router */
    private $router;

    /**
     * @return mixed
     * @throws \exceptions\BasicError
     */
    private function callAction()
    {
        $controller = $this->router->getController();
        $method = $this->router->getMethod();
        $this->request = $controller->collectRequest($method);
        $this->request->validate();

        return $controller->$method($this->request);
    }

    protected function getBaseConfigName()
    {
        return
            APP_ROOT . DIRECTORY_SEPARATOR
            . self::APP_CONFIGS_PATH . DIRECTORY_SEPARATOR
            . 'env.php';
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
        $this->router = RouterFactory::create($this->isWeb());
    }

    public function isWeb()
    {
        return $this->isWeb;
    }

    public function run() : int
    {
        try {
            $httpCode = $this->callAction();
//        } catch (ValidationError $e) {
//        } catch (ControllerError $e) {
        } catch (\Throwable $e) {
            $httpCode = 500;
        }

        return $httpCode;
    }
}