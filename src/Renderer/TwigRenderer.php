<?php

namespace Neecride\Framework\Renderer;

use Alterouter\Alterouter;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;

class TwigRenderer implements RendererInterface
{
    private LoaderInterface $loader;
    private Environment $twig;

    public function __construct(string $path, Alterouter $router, string $baseUrl)
    {
        $this->loader = new FilesystemLoader($path);
        $this->twig = new Environment($this->loader, [
            'debug' => true,
        ]);
        $this->twig->addExtension(new DebugExtension());
        $this->twig->addExtension(new TwigExtension($router, $baseUrl));
    }

    /**
     * @param string $namespace
     * @param string|null $path
     * @return void
     * @throws LoaderError
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        $this->loader->addPath($path, $namespace);
    }

    public function addGlobal(string $key, mixed $value): void
    {
        $this->twig->addGlobal($key, $value);
    }

    /**
     * @param string $view
     * @param array $params
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(string $view, array $params = []): string
    {
        return $this->twig->render($view, $params);
    }
}