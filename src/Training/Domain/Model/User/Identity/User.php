<?php

namespace Training\Domain\Model\User\Identity;

use Training\Domain\Model\Credentials;
use Training\Domain\Model\FullName;

class User
{
    /**
     * @var UserId
     */
    private $id;

    private $name;

    private $lastName;

    private $username;

    private $passwordHash;

    public function __construct(UserId $id, FullName $fullName, Credentials $credentials)
    {
       $this->id = $id;
       $this->name = $fullName->name();
       $this->lastName = $fullName->lastName();
       $this->username = $credentials->username();
       $this->passwordHash = $credentials->password();
    }

    public function authenticate($password, callable $checkHash)
    {
        if (! $checkHash($password, $this->passwordHash)) {
            throw new \InvalidArgumentException('Wrong password');
        }

        return true;
    }
}