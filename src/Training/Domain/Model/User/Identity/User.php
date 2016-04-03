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
    
    public function encryptPassword($password, $algorithm, callable $createHash)
    {
        $this->passwordHash = $createHash($password, $algorithm);

        return $this;
    }

    public function confirmPassword($password, $confirmPassword)
    {
        if ($password !== $confirmPassword) {
            throw new \InvalidArgumentException('Password and confirm password must be equal');
        }

        return true;
    }

    public function name()
    {
        return $this->name;
    }
}