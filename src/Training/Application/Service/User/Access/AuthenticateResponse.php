<?php

namespace Training\Application\Service\User\Access;

use Training\Domain\Model\User\Identity\User;

class AuthenticateResponse
{
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