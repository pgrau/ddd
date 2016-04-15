<?php

namespace Common\Domain\Model;

use Assert\Assertion;

trait ProtectsInvariants
{
    private function assertArgumentsAreSame($value, $expected, $aMessage = null)
    {
        Assertion::same($value, $expected, $aMessage);
    }
}