<?php

namespace Training\Infrastructure\Persistence\Doctrine\User\Identity;

use Training\Domain\Model\User\Identity\User;
use Training\Domain\Model\User\Identity\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    public function persist(User $user)
    {
        return $user;
    }

    public function findOneByUsername($username)
    {
        // TODO: Implement findOneByUsername() method.
    }
}
