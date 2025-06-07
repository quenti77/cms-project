<?php

use Neecride\Framework\App;

define('ROOT', realpath(__DIR__) . '/../');

require ROOT . '/vendor/autoload.php';

$app = new App(ROOT . '/config');
$app->run();
