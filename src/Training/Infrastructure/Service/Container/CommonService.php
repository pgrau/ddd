<?php

namespace Training\Infrastructure\Service\Container;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use League\Container\ServiceProvider\AbstractServiceProvider;

class CommonService extends AbstractServiceProvider
{
    protected $provides = [
        'db_params',
        'entity_manager',
        'doctrine_path_mapping',
        'debugbar',
        'template'
    ];

    public function register()
    {
        $this->registerDbParams();
        $this->registerDoctrinePathMapping();
        $this->registerEntityManager();
        $this->registerDebugbar();
        $this->registerTemplate();
    }

    private function registerDbParams()
    {
        $params = [
            'driver'      => 'pdo_mysql',
            'host'        => '127.0.0.1',
            'user'        => 'vagrant',
            'password'    => 'vagrant',
            'dbname'      => 'training',
            'charset'     => 'utf8'
        ];

        $this->getContainer()->add('db_params', $params);
    }

    private function registerDoctrinePathMapping()
    {
        $paths = [__DIR__ . "/../../Persistence/Doctrine/mapping"];

        $this->getContainer()->add('doctrine_path_mapping', $paths);
    }

    private function registerEntityManager()
    {
        $config = Setup::createXMLMetadataConfiguration($this->getContainer()->get('doctrine_path_mapping'));
        $entityManager = EntityManager::create($this->getContainer()->get('db_params'), $config);
        $this->getContainer()->add('entity_manager', $entityManager);
    }

    private function registerDebugbar()
    {
        $this->getContainer()->add('debugbar', '\DebugBar\StandardDebugBar');
    }

    private function registerTemplate()
    {
        $this->getContainer()->add(
            'template',
            \Training\Infrastructure\UI\View\Plates\getTemplate($this->getContainer())
        );
    }
}
