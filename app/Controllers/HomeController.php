<?php

namespace Neecride\Cms\Controllers;

use Neecride\Framework\Renderer\RendererInterface;

class HomeController
{
    public function __construct(private readonly RendererInterface $renderer)
    {
    }

    public function index(): void
    {
        echo $this->renderer->render('home.twig', ['name' => 'John']);
    }

    public function comment(): void
    {
        header('Location: /');
    }
}