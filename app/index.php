<?php

define('APP_ROOT', __DIR__);

require_once "autoload.php";

$app = classes\app\Application::create();
http_response_code($app->run());
