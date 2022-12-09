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

    public function testDummyToo()
    {
        $values= ['extra', 'something', 'I', 'cannot', 'think','eggstra'];
        $counter = 0;
        foreach ($values as $val)
        {
          $dc = new dummyclass($val);
          $this->assertTrue($dc instanceof dummyclass);
          $this->assertEquals($val, $dc->getValue());
        }
    }

    public function testDummyNumber()
    {
        $value = 12673;
        $dc = new dummyclass($value);
        $this->assertTrue($dc instanceof dummyclass);
        $this->assertEquals($value, $dc->getValue());
    }
}
