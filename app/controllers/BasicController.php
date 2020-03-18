<?php

namespace controllers;

use exceptions\ControllerError;
use models\requests\IWebRequest;

abstract class BasicController
{
    /**
     * @param $name
     * @param $arguments
     * @throws \exceptions\BasicError
     */
    public function __call($name, $arguments)
    {
        throw ControllerError::create(ControllerError::UNKNOWN_ACTION, $name);
    }

    /**
     * @param $methodName
     * @return IWebRequest
     * @throws \exceptions\BasicError
     */
    public function collectRequest($methodName) : IWebRequest
    {
        try {
            $method = new \ReflectionMethod(static::class, $methodName);
        } catch (\ReflectionException $e) {
            throw ControllerError::create(ControllerError::UNKNOWN_ACTION, $methodName, $e);
        }

        $param = $method->getParameters();
        if (count($param) !== 1) {
            throw ControllerError::create(ControllerError::INVALID_ACTION_PARAMS, $methodName);
        }

        try {
            $param = reset($param);
            $className = $param->getClass()->getName();
        } catch (\Throwable $e) {
            throw ControllerError::create(ControllerError::INVALID_ACTION_PARAMS_TYPE, $methodName, $e);
        }

        $request = new $className;

        if (!($request instanceof IWebRequest)) {
            throw ControllerError::create(ControllerError::INVALID_ACTION_PARAMS_TYPE, $methodName);
        }

        $request->collect();

        return $request;
    }
}