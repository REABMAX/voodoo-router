<?php

namespace Voodoo\Router\Contracts;

/**
 * Interface RouterConfiguration
 * @package Voodoo\Router\Contracts
 */
interface RouterConfiguration
{
    /**
     * @return array
     */
    public function getRoutes(): array;
}