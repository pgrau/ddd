<?php

namespace Training\Domain\Model\User\Identity;

interface UserRepository
{
    /** @return User */
    public function findByUsername($username);

    /** @return User|\Exception */
    public function findOneByUsername($username);
}