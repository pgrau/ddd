<?php

namespace Training\Infrastructure\Service\Container;

function getContainer()
{
    $container = new \League\Container\Container;

    $container->addServiceProvider('Training\Infrastructure\Service\Container\CommonService');

    return $container;
}