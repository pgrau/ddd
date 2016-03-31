<?php

namespace Training\Domain\Model\User\Identity;

use Ramsey\Uuid\Uuid;

class UserId
{
    /**
     * @var string
     */
    private $id;

    public function __construct($id = null)
    {
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
    }

    public function id()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->id();
    }
}
