<?php

require_once __DIR__.'/vendor/autoload.php';

$parameters = require __DIR__.'/config/Parameters.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(
    (new \Training\Infrastructure\Persistence\Doctrine\EntityManagerFactory($parameters))->build()
);