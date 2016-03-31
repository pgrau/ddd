<?php

namespace Training\Infrastructure\UI\Controller;

use FastRoute\RouteCollector;
use Interop\Container\ContainerInterface;

class Base
{
    /** @var ContainerInterface */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}