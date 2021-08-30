<?php

spl_autoload_register('AutoLoader');

function AutoLoader($className) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    require_once 'classes' . DIRECTORY_SEPARATOR . $file . '.php';
}