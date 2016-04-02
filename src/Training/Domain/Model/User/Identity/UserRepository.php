<?php

namespace Training\Domain\Model\User\Identity;

interface UserRepository
{
    /** @return User|\Exception */
    public function findOneByUsername($username);
}