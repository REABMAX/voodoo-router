<?php

namespace Voodoo\Router;

use Voodoo\Router\Contracts\RouterConfiguration as RouterConfigurationInterface;

/**
 * Class RouterConfiguration
 * @package Voodoo\Router
 */
class RouterConfiguration implements RouterConfigurationInterface
{
    /**
     * @var array
     */
    protected $routes = [];

    /**
     * RouterConfiguration constructor.
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = array_merge($this->routes, $routes);
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}