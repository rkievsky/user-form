<?php

namespace classes\routers;

interface IRouter
{
    public function getController();

    public function getMethod();
}