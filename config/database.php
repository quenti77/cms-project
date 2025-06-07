<?php

use Neecride\Framework\Database\Connection;
use Neecride\Framework\Database\Dsn;

return [
    'db.type' => DI\env('DB_TYPE', 'pgsql'),
    'db.host' => DI\env('DB_HOST', '127.0.0.1'),
    'db.port' => DI\env('DB_PORT', 5432),
    'db.name' => DI\env('DB_NAME', 'cms_project'),
    'db.user' => DI\env('DB_USER', 'root'),
    'db.password' => DI\env('DB_PASSWORD', 'root'),

    Dsn::class => DI\create(Dsn::class)
        ->constructor(
            DI\get('db.type'),
            DI\get('db.host'),
            DI\get('db.port'),
            DI\get('db.name'),
        ),

    Connection::class => DI\create(Connection::class)
        ->constructor(
            DI\get(Dsn::class),
            DI\get('db.user'),
            DI\get('db.password'),
        ),
];
