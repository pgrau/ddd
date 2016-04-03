<?php

require_once __DIR__.'/vendor/autoload.php';

$container = \Training\Infrastructure\Service\Container\getContainer();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(
    (new \Training\Infrastructure\Persistence\Doctrine\EntityManagerFactory($container->get('db_params')))->build()
);