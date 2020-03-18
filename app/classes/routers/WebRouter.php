<?php

namespace classes\routers;

use controllers\BasicController;
use controllers\UserController;
use exceptions\ControllerError;

class WebRouter implements IRouter
{
    /** @var string $route */
    private $route = null;

    /** @var bool $parsed */
    private $parsed = false;

    /** @var string $controller */
    private $controller = null;

    /** @var string $method */
    private $method = null;

    /**
     * @throws \exceptions\BasicError
     */
    private function parseRoute()
    {
        if ($this->parsed) {
            return;
        }

        switch ($this->route) {
            case '/':
                $this->controller = UserController::class;
                $this->method = 'index';
                break;
            case '/user/login':
                $this->controller = UserController::class;
                $this->method = 'login';
                break;
            case '/user/register':
                $this->controller = UserController::class;
                $this->method = 'register';
                break;
            case '/user/profile':
                $this->controller = UserController::class;
                $this->method = 'profile';
                break;
            default:
                throw ControllerError::create(ControllerError::UNKNOWN_ROUTE, $this->route);
        }

        $this->parsed = true;
    }

    public function __construct()
    {
        $this->route = $_SERVER['REQUEST_URI'];
    }

    /**
     * @return BasicController
     * @throws \exceptions\BasicError
     */
    public function getController(): BasicController
    {
        $this->parseRoute();

        return new ${$this->controller};
    }

    /**
     * @return string
     * @throws \exceptions\BasicError
     */
    public function getMethod(): string
    {
        $this->parseRoute();

        return $this->method;
    }
}