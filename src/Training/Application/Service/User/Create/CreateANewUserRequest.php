<?php

namespace Training\Application\Service\User\Create;

class CreateANewUserRequest
{
    private $name;

    private $lastName;

    private $username;

    private $password;

    private $confirmPassword;

    public function __construct($name, $lastName, $username, $password, $confirmPassword)
    {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function username()
    {
        return $this->username;
    }

    public function password()
    {
        return $this->password;
    }

    public function confirmPassword()
    {
        return $this->confirmPassword;
    }

    public function name()
    {
        return $this->name;
    }

    public function lastName()
    {
        return $this->lastName;
    }
}