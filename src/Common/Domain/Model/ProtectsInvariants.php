<?php

namespace Common\Domain\Model;

use Assert\Assertion;

trait ProtectsInvariants
{
    private function assertSame($value, $expected, $aMessage = null)
    {
        Assertion::same($value, $expected, $aMessage);
    }
}