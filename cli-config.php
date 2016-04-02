<?php

require_once __DIR__.'/vendor/autoload.php';

$parameters =  require_once __DIR__.'/config/Parameters.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(
    (new \Mepas\Infrastructure\Persistence\Doctrine\EntityManagerFactory($parameters))->build()
);