<?php

/**
 * autoload to class
 */
class autoloader
{
    public function __construct() {
        spl_autoload_register(array($this, 'loader'));
    }
    public function loader($className) {
        // Массив папок, в которых могут находиться необходимые классы
        $array_paths = array(
            '/components/',
            '/class/',
        );
        foreach ($array_paths as $path) {
            $path = ROOT . $path . $className . '.php';
        if (is_file($path)) {
            include_once $path;
        }
        }
    }
}