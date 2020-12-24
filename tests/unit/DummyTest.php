<?php

use PHPUnit\Framework\TestCase;
use dummy\dummyclass;

/**
 * Dummyclass testcases
 *
 * @author JoSSte
 */
class DummyTest extends TestCase
{
    /**
     * @test
     */
    public function testDummyBasic()
    {
        $value = 'comment';
        $dc = new dummyclass($value);
        $this->assertTrue($dc instanceof dummyclass);
        $this->assertEquals($value, $dc->getValue());
    }
}
