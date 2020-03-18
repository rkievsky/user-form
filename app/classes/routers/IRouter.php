<?php

namespace classes\routers;

use controllers\BasicController;

interface IRouter
{
    public function getController() : BasicController;

    public function getMethod() : string;
}