<?php

namespace classes\routers;

class WebRouter implements IRouter
{
    private $route = null;

    public function __construct()
    {
        $this->route = '';
    }
}