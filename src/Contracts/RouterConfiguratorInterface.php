<?php

namespace Voodoo\Router\Contracts;

/**
 * Interface RouterConfiguratorInterface
 * @package Voodoo\Router\Contracts
 */
interface RouterConfiguratorInterface
{
    /**
     * @param RouterConfiguration $configuration
     * @return mixed
     */
    public function configureRouter(RouterConfiguration $configuration);

    /**
     * @return mixed
     */
    public function getRouter();
}