<?php

namespace Training\Application\Service\User\Access;

use Training\Domain\Model\User\Identity\User;

class AuthenticateUserResponse
{
    /* @var $user User */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function user()
    {
        return $this->user;
    }
}

