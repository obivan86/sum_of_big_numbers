<?php 

use App\Libraries\LargeInteger;

class LargeIntegerTest extends PHPUnit_Framework_TestCase
{

	public function equalNumbers()
	{
		return array(
			array(new LargeInteger('11111'),new LargeInteger('11111')),
			array(new LargeInteger('98989898998998989898989898989898989999898989899898999998989899898989898'), new LargeInteger('98989898998998989898989898989898989999898989899898999998989899898989898'))
		);
	}

	public function notEqualNumbers()
	{
		return array(
			array(new LargeInteger('1232321232312231321321312312'), new LargeInteger('3443214534234543129888767654')),
			array(new LargeInteger('1212121212'), new LargeInteger('787878877878787878788787877878')),
			array(new LargeInteger('89880989049873982749823749827'), new LargeInteger('43432342342'))
		);
	}

	public function greaterThanNumbers()
	{
		return array(
			array(new LargeInteger('312312313212312312'), new LargeInteger('3123123121')),
			array(new LargeInteger('98876565'), new LargeInteger('87654567'))
		);
	}

	public function lessThanNumbers()
	{
		return array(
			array(new LargeInteger('212312313212312312'), new LargeInteger('889800123123121')),
			array(new LargeInteger('98876565'), new LargeInteger('87654567'))
		);
	}

	public function greaterOrEqualThanNumbers()
	{
		return array(
			array(new LargeInteger('9999999999999999999999999999999999999999999'), new LargeInteger('9999999999999999999999999999999999999999999')),
			array(new LargeInteger('9999999999999999999999999999999999999999999'), new LargeInteger('9999999999999999999999999999999999999999998')),
			array(new LargeInteger('123213'), new LargeInteger('123'))
		);
	}

	public function lessOrEqualThanNumbers()
	{
		return array(
			array(new LargeInteger('3279817239827173291732'), new LargeInteger('3279817239827173291732')),
			array(new LargeInteger('2332132121'), new LargeInteger('433243443242432432424')),
			array(new LargeInteger('8'), new LargeInteger('9'))
		);
	}

	public function addNumbers()
	{
		return array(
			array(new LargeInteger('17'), new LargeInteger('15'), new LargeInteger('32')),
            array(new LargeInteger('99999999'), new LargeInteger('99999999'), new LargeInteger('199999998')),
            array(new LargeInteger('111111111111111'), new LargeInteger('99999999'), new LargeInteger('111111211111110')),
            array(new LargeInteger('99999999'),new LargeInteger('111111111111111'), new LargeInteger('111111211111110'))
		);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testThrowIfNegativeNumberPassed()
	{
		$a = new LargeInteger('-321');
	}

	/**
	 * @dataProvider equalNumbers
	 * @param $a
	 * @param $b
	 */
	public function testEqualTo($a, $b)
	{
		$this->assertTrue($a->equalTo($b));
	}

	/**
	 * @dataProvider notEqualNumbers
	 * @param $a
	 * @param $b
	 */
	public function testNotEqualTo($a, $b)
	{
		$this->assertTrue($a->notEqualTo($b));
	}


	/**
	 * @dataProvider greaterThanNumbers
	 * @param $a
	 * @param $b
     */
	public function testGreaterThan($a, $b)
	{
		$this->assertTrue($a->greaterThan($b));
	}

	/**
	 * @dataProvider lessThanNumbers
	 * @param $a
	 * @param $b
	 */
	public function testLessThan($a, $b)
	{
		$this->assertTrue(! $a->lessThan($b));
	}


	/**
	 * @dataProvider greaterOrEqualThanNumbers
	 * @param $a
	 * @param $b
	 */
	public function testGreaterOrEqualThan($a, $b)
	{
		$this->assertTrue($a->greaterOrEqualThan($b));
	}

	/**
	 * @dataProvider lessOrEqualThanNumbers
	 * @param $a
	 * @param $b
	 */
	public function testLessOrEqualThan($a, $b)
	{
		$this->assertTrue($a->lessOrEqualThan($b));
	}


	/**
	 * @dataProvider addNumbers
	 * @param $a
	 * @param $b
	 * @param $sum
     */
	public function testAdd($a, $b, $sum){
		$this->assertEquals($sum->getValue(), $a->add($b)->getValue());
	}
}
