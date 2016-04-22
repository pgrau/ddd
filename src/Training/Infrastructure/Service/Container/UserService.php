<?php

namespace Training\Infrastructure\Service\Container;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Training\Application\Service\User\Access\AuthenticateUserService;

class UserService extends AbstractServiceProvider
{
    protected $provides = [
        'user_repository',
        'create_new_user_service',
        'authenticate_user_service'
    ];

    public function register()
    {
        $this->registerUserRepository();
        $this->registerCreateUserService();
        $this->registerAuthenticateUserService();
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
        $namespace = 'Training\Application\Service\User\Create\CreateANewUserService';
        $this->getContainer()->add('create_new_user_service', $namespace)
            ->withArgument($this->getContainer()->get('user_repository'))
        ;
    }

    private function registerAuthenticateUserService()
    {
        $namespace = AuthenticateUserService::class;
        $this->getContainer()->add('authenticate_user_service', $namespace)
            ->withArgument($this->getContainer()->get('user_repository'))
        ;
    }
}
