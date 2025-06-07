<?php

namespace Neecride\Framework;

use Alterouter\Alterouter;
use Alterouter\Request;
use DI\Container;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Dotenv\Dotenv;
use Exception;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class App
{
    private Container|null $container = null;

    public function __construct(private readonly string $configFolder)
    {
    }

    /**
     * @return Container
     * @throws Exception
     */
    public function getContainer(): Container
    {
        if ($this->container === null) {
            $dotEnv = Dotenv::createImmutable(ROOT);
            $dotEnv->safeLoad();

            $containerBuilder = new ContainerBuilder();

            $rdi = new RecursiveDirectoryIterator($this->configFolder, FilesystemIterator::SKIP_DOTS);
            $rii = new RecursiveIteratorIterator($rdi);

            /** @var FilesystemIterator $file */
            foreach ($rii as $file) {
                if ($file->getExtension() === 'php') {
                    $containerBuilder->addDefinitions($file->getRealPath());
                }
            }

            $this->container = $containerBuilder->build();
        }

        return $this->container;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        $routerPath = $this->getContainer()->get('router.path');
        $router = $this->getContainer()->get(Alterouter::class);

        $rdi = new RecursiveDirectoryIterator($routerPath, FilesystemIterator::SKIP_DOTS);
        $rii = new RecursiveIteratorIterator($rdi);

        /** @var FilesystemIterator $file */
        foreach ($rii as $file) {
            if ($file->getExtension() === 'php') {
                $this->initRoutesInFile($router, $file->getRealPath());
            }
        }

        $this->processRoute($router);
    }

    private function initRoutesInFile(Alterouter $router, string $path): void
    {
        require $path;
    }

    /**
     * @param Alterouter $router
     * @return void
     * @throws DependencyException
     * @throws NotFoundException
     * @throws Exception
     */
    private function processRoute(Alterouter $router): void
    {
        $route = $router->match(Request::getMethodFromGlobals(), Request::getPathFromGlobals());

        if ($route !== null) {
            $handler = $route->getHandler();
            if (is_string($handler)) {
                $handler = explode('@', $handler, 2);
                [$controller, $method] = $handler;
                $controller = $this->getContainer()->get($controller);
                $controller->$method($route->getMatches());
            } else {
                call_user_func_array($handler, $route->getMatches());
            }
        }
    }
}