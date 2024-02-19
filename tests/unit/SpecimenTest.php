<?php

use PHPUnit\Framework\TestCase;
use dummy\SpecimenClass;

/**
 * SpecimenClass testcases
 *
 * @author JoSSte
 */
class DummyTest extends TestCase
{
  /**
   * @test
   */
  public function testDummyBasic(): void
  {
    $value = 'comment';
    $dc = new SpecimenClass($value);
    $this->assertTrue($dc instanceof SpecimenClass);
    $this->assertEquals($value, $dc->getValue(), 'Testing simple string');
  }

  /**
   * testing without paramaters... = more assertions, less testcases (assertions do not count in junit test report)
   */
  public function testDummyToo(): void
  {
    $values = ['extra', 'something', 'I', 'cannot', 'think', 'eggstra'];
    foreach ($values as $val) {
      $dc = new SpecimenClass($val);
      $this->assertTrue($dc instanceof SpecimenClass);
      $this->assertEquals($val, $dc->getValue());
      $this->assertEquals(0, $dc->getNumber());
    }
  }

  public function testDummyNumber(): void
  {
    $value = 12673;
    $dc = new SpecimenClass($value);
    $this->assertTrue($dc instanceof SpecimenClass);
    $this->assertEquals($value, $dc->getValue());
    $this->assertEquals(0, $dc->getNumber());
  }

  public function testDummyNumberSet(): void
  {
    $value = 12673;
    $valuetoo = 'hello';
    $dc = new SpecimenClass($value);
    $this->assertTrue($dc instanceof SpecimenClass);
    $this->assertEquals($value, $dc->getValue());
    $dc->setValue($valuetoo);
    $this->assertEquals($valuetoo, $dc->getValue());
    $this->assertEquals(0, $dc->getNumber());
  }


  /**
   * @dataProvider providerStrings
   */
  public function testDummyParameterized($value, string $explain, string $expectedResult = '¤', bool $expectEquality = true)
  {
    if ($expectedResult == '¤') {
      $expectedResult = $value;
    }
    $dc = new SpecimenClass($value);
    $this->assertTrue($dc instanceof SpecimenClass);
    if ($expectEquality) {
      $this->assertEquals($value, $dc->getValue(), $explain);
    } else {
      $this->assertNotEquals($expectedResult, $dc->getValue(), $explain);
    }
  }

  /**
   * @dataProvider providerStrings
   */
  public function providerStrings()
  {
    return array(
      array('extra', 'checking string'),
      array('something', 'checking string'),
      array('I', 'checking string'),
      array('cannot', 'checking string'),
      array('think', 'checking string'),
      array(false, 'checking boolean', ''),
      array(0, 'checking int'),
      array(1.1, 'checking decimal')
    );
  }
}
