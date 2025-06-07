<?php

namespace Neecride\Framework\Renderer;

use Alterouter\Alterouter;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class TwigFactory
{
    public function __invoke(ContainerInterface $container): TwigRenderer|null
    {
        try {
            return new TwigRenderer($container->get('views.path'), $container->get(Alterouter::class));
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface) {
        }

        return null;
    }
}