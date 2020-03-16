<?php

define('APP_ROOT', __DIR__);

require_once "autoload.php";

$app = classes\app\ConsoleApplication::create();
$app->run();