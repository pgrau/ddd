<?php

namespace Training\Infrastructure\UI\Controller;

use FastRoute\RouteCollector;

final class Home extends Base
{
    public static function addRoutes(RouteCollector $routeCollector)
    {
        $routeCollector->addRoute('GET', '/', [self::class, 'init']);
    }

    public function init()
    {
        /** @var $tpl \League\Plates\Engine */
        $tpl = $this->container->get('template');

        return $tpl->render('home::index', []);
    }
}