<?php

use Alterouter\Alterouter;

return [
    'router.path' => ROOT . '/app/routes',
    Alterouter::class => DI\create(Alterouter::class),
];
