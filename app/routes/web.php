<?php

use Alterouter\Alterouter;
use Neecride\Cms\Controllers\HomeController;

/**
 * @var Alterouter $router
 */

$router->get('/', tr([HomeController::class, 'index']), 'home.index');
$router->post('/comment', tr([HomeController::class, 'comment']), 'home.comment');
