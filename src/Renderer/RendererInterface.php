<?php

namespace Neecride\Framework\Renderer;

interface RendererInterface
{
    public function addPath(string $namespace, string|null $path = null): void;

    public function addGlobal(string $key, mixed $value): void;

    public function render(string $view, array $params = []): string;
}