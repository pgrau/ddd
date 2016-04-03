<?php

namespace Training\Application\Service\User\Access;

use Training\Domain\Model\User\Identity\User;

class CreateUserResponse
{
    /**
     * @var User
     */
    private $anUser;

    public function __construct(User $anUser)
    {
        $this->anUser = $anUser;
    }

    /**
     * @return User
     */
    public function user()
    {
        return $this->anUser;
    }
}