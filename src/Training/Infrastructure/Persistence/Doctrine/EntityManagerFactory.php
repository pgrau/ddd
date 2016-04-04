<?php

namespace Training\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class EntityManagerFactory
{
    private $dbParams;

    public function __construct(array $paremeters)
    {
        $this->dbParams = $paremeters;
    }

    /**
     * @return EntityManager
     */
    public function build()
    {
        $dirMapping = [
            __DIR__.'/mapping'
        ];

        return EntityManager::create(
            $this->dbParams,
            Setup::createXMLMetadataConfiguration($dirMapping)
        );
    }
}
