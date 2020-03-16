<?php

/**
 * Функция загрузчик классов. Ищет классы в папках, исходя из их namespace
 *
 * @param string      $class
 * @param string|null $file_extensions
 */
spl_autoload_register(function (string $class, string $file_extensions = null) {
    if ($file_extensions === null) {
        $file_extensions = spl_autoload_extensions();
    }

    $path = explode('\\', $class);
    if (count($path) > 1) {
        $className = array_slice($path, count($path) - 1, 1)[0];
        $path = implode(DIRECTORY_SEPARATOR, array_slice($path, 0, count($path) - 1));
    } else {
        $path = '.';
        $className = $class;
    }

    foreach (explode(',', $file_extensions) as $fileExt) {
        $fileName = $path . DIRECTORY_SEPARATOR . $className . $fileExt;

        if (file_exists($fileName)) {
            require $fileName;
            break;
        }
    }
});