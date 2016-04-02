<?php

namespace Training\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class EntityManagerFactory
{
    private $paremeters;

    public function __construct(array $paremeters)
    {
        $this->paremeters = $paremeters;
    }

    /**
     * @return EntityManager
     */
    public function build()
    {
        $db = $this->paremeters['databases']['bd1'];
        $dirMapping = [
            __DIR__.'/mapping'
        ];

        return EntityManager::create(
            $db,
            Setup::createXMLMetadataConfiguration($dirMapping)
        );
    }
}
