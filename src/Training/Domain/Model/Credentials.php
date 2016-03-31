<?php

namespace Training\Domain\Model;

class Credentials
{
    private $username;

    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function username()
    {
        return $this->username;
    }

    public function password()
    {
        return $this->password;
    }
}
