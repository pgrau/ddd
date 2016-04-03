<?php

namespace Training\Infrastructure\Service\Container;

/**
 * @return \League\Container\Container
 */
function getContainer()
{
    $container = new \League\Container\Container;

    $container->addServiceProvider('Training\Infrastructure\Service\Container\CommonService');
    $container->addServiceProvider('Training\Infrastructure\Service\Container\UserService');

    return $container;
}