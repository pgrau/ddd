<?php

namespace Training\Infrastructure\UI\View\Plates;

use Interop\Container\ContainerInterface;
use League\Plates\Engine;
use Training\Infrastructure\Ui\View\Plates\Extension\DebugBar;

function getTemplate(ContainerInterface $container)
{
    $template = new Engine();

    $template->addFolder('layout', __DIR__ . '/view/layout');
    $template->addFolder('home', __DIR__ . '/view/home');
    $template->addFolder('login', __DIR__ . '/view/login');

    $template->loadExtensions(
        [
            new DebugBar($container->get('debugbar')->getJavascriptRenderer())
        ]
    );

    return $template;
}