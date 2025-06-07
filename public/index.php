<?php

use Neecride\Framework\App;

define('ROOT', realpath(__DIR__) . '/../');

require ROOT . '/vendor/autoload.php';

function tr(array $handler): string
{
    return implode('@', $handler);
}

$app = new App(ROOT . '/config');
try {
    $app->run();
} catch (Exception $e) {
    dd($e);
}
