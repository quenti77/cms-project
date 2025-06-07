<?php

return [
    'app.name' => DI\env('APP_NAME', dirname(ROOT)),
    'app.env' => DI\env('APP_ENV', 'local'),
    'app.url' => DI\env('APP_URL', 'http://localhost:8000'),
    'app.router.path' => ROOT . '/app/routes',
];
