<?php

namespace Training\Infrastructure\UI\Controller;

use FastRoute\RouteCollector;

final class Login extends Base
{
    public static function addRoutes(RouteCollector $routeCollector)
    {
        $routeCollector->addRoute('GET', '/login', [self::class, 'init']);
    }

    public function init()
    {
        /** @var $tpl \League\Plates\Engine */
        $tpl = $this->container->get('template');

        return $tpl->render('login::index', []);
    }
}