<?php

namespace Voodoo\Router\Configurators;

use League\Route\Route;
use League\Route\RouteGroup;
use League\Route\Router;
use Voodoo\Router\Contracts\RouterConfiguration;
use Voodoo\Router\Contracts\RouterConfiguratorInterface;

/**
 * Class LeagueRouterConfigurator
 * @package Voodoo\Router\Configurators
 */
class LeagueRouterConfigurator implements RouterConfiguratorInterface
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * LeagueRouterConfigurator constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param RouterConfiguration $configuration
     * @return Router|mixed
     * @throws \Exception
     */
    public function configureRouter(RouterConfiguration $configuration)
    {
        foreach ($configuration->getRoutes() as $name => $options) {
            if (is_callable($options)) {
                $this->createGroup($this->router, $name, $options());
            } else {
                $this->createRoute($this->router, $name, $options);
            }
        }

        return $this->router;
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * @param Router $router
     * @param $name
     * @param $options
     */
    protected function createRoute(Router $router, $name, $options)
    {
        $route = $router->map($options['method'], $options['path'], $options['action']);
        $this->configureRoute($route, $options);
    }

    /**
     * @param Router $router
     * @param $name
     * @param $options
     * @throws \Exception
     */
    protected function createGroup(Router $router, $name, $options)
    {
        if (empty($options['children'])) {
            throw new \Exception(sprintf("Route group %s does not have children defined", $name));
        }

        $children = $options['children'];

        $router->group($options['path'], function(RouteGroup $route) use ($children) {
            foreach ($children as $child) {
                $childRoute = $route->map($child['method'], $child['path'], $child['action']);
                $this->configureRoute($childRoute, $child);
            }
        });
    }

    /**
     * @param Route $route
     * @param $options
     */
    protected function configureRoute(Route $route, $options)
    {
        if (!empty($options['port'])) {
            $route->setPort($options['port']);
        }

        if (!empty($options['scheme'])) {
            $route->setScheme($options['scheme']);
        }

        if (!empty($options['host'])) {
            $route->setHost($options['host']);
        }

        if (!empty($options['scheme'])) {
            $route->setScheme($options['scheme']);
        }

        if (!empty($options['strategy'])) {
            $route->setStrategy($options['strategy']);
        }
    }
}