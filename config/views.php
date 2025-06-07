<?php

use Neecride\Framework\Renderer\RendererInterface;
use Neecride\Framework\Renderer\TwigFactory;

return [
    'views.path' => ROOT . '/app/views',
    RendererInterface::class => DI\factory(TwigFactory::class),
];
