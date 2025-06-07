<?php

namespace Neecride\Framework\Renderer;

use Alterouter\Alterouter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    public function __construct(private readonly Alterouter $router, private readonly string $baseUrl)
    {
    }

    public function getFunctions(): array
    {
        return [
            ...parent::getFunctions(),
            new TwigFunction('path', [$this, 'generateUri']),
        ];
    }

    public function generateUri(string $name, array $parameters = []): string
    {
        return $this->baseUrl . $this->router->generate($name, $parameters);
    }
}