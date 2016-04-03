<?php

namespace Training\Infrastructure\Service\Container;

use League\Container\ServiceProvider\AbstractServiceProvider;

class UserService extends AbstractServiceProvider
{
    protected $provides = [
        'user_repository',
        'create_user_service'
    ];

    public function register()
    {
        $this->registerUserRepository();
        $this->registerCreateUserService();
    }

    private function registerUserRepository()
    {
        /** @var  $entityManager \Doctrine\ORM\EntityManager */
        $entityManager = $this->getContainer()->get('entity_manager');
        $this->getContainer()
            ->add('user_repository', $entityManager->getRepository('Training\Domain\Model\User\Identity\User'))
        ;
    }

    private function registerCreateUserService()
    {
        $this->getContainer()->add('create_user_service', 'Training\Application\Service\User\Access\CreateUserService')
            ->withArgument($this->getContainer()->get('user_repository'))
        ;
    }
}
