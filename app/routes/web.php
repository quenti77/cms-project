<?php

use Alterouter\Alterouter;
use Neecride\Cms\Controllers\HomeController;

/**
 * @var Alterouter $router
 */

$router->get('/', implode('@', [HomeController::class, 'index']));
