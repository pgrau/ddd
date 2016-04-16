<?php

namespace Training\Domain\Model\User\Identity;

interface UserRepository
{
    public function persist(User $user);

    public function findOneByUsername($username);
}