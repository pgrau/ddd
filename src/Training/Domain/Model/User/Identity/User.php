<?php

namespace Training\Domain\Model\User\Identity;

use Common\Domain\Model\ProtectsInvariants;
use Training\Domain\Model\Credentials;
use Training\Domain\Model\FullName;

class User
{
    const PASSWORD_ALGORITHM = PASSWORD_DEFAULT;
    const PASSWORD_HASH      = 'password_hash';
    const PASSWORD_VERIFY    = 'password_verify';

    /**
     * @var UserId
     */
    private $id;

    private $name;

    private $lastName;

    private $username;

    private $passwordHash;

    use ProtectsInvariants;

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
        $this->assertArgumentsAreSame($password, $confirmPassword, 'Password and confirm password must be equal');
    }

    public function authenticate($password, callable $verify)
    {
        if (!$verify($password, $this->passwordHash())) {
            throw new UserException('Incorrect password');
        }

        return true;
    }

    public function name()
    {
        return $this->name;
    }

    public function id()
    {
        return $this->id;
    }

    public function passwordHash()
    {
        return $this->passwordHash;
    }
}