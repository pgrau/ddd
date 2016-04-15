<?php

namespace Training\Domain\Model;

class FullNameTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldReturnAFullNameWhenIsUsedAsString()
    {
        $expected = 'Juan García';

        $this->assertSame($expected, (string) new FullName('Juan', 'García'));
    }
}
