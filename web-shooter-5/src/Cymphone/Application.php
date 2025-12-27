<?php

namespace Cymphone;

use Cymphone\Container\Container;
use Cymphone\Http\Request;
use Cymphone\Http\Response;
use Cymphone\Routing\Router;

class Application
{
    private Container $container;
    private Router $router;

    public function __construct()
    {
        $this->container = new Container();
        $this->router = new Router();
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function handleRequest(Request $request): Response
    {
        return $this->router->dispatch($request);
    }
}

