<?php

namespace Training\Domain\Model;

class FullName
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastName;

    public function __construct($name, $lastName)
    {
        $this->setName($name);
        $this->setLastName($lastName);
    }

    public function name()
    {
        return $this->name;
    }

    public function lastName()
    {
        return $this->lastName;
    }

    public function __toString()
    {
        return $this->name() . " " . $this->lastName();
    }

    private function setName($name)
    {
        $this->name = $name;
    }

    private function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
}
