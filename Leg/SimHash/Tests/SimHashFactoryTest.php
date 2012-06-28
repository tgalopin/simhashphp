<?php

/*
 * This file is part of the SimHashPhp package.
 *
 * (c) Titouan Galopin <http://titouangalopin.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Leg\SimHash\Tests;

use Leg\SimHash\SimHashFactory;

class SimHashFactoryTest extends \PHPUnit_Framework_TestCase
{
	protected $backupGlobalsBlacklist = array('simHashFactory');
	
	public function testHashSize()
	{
		$factory = new SimHashFactory();
		$this->assertEquals(32, $factory->getHashSize());
		
		$factory = new SimHashFactory(16);
		$this->assertEquals(16, $factory->getHashSize());
		
		$factory->setHashSize(18);
		$this->assertEquals(18, $factory->getHashSize());
	}
	
	public function testDefaultWordsSeparator()
	{
		$factory = new SimHashFactory();
		
		$text = 'Mary-jane is very tall. She is in the 9th grade.';
		
		$this->assertEquals(array(
			'Mary', 'jane', 'is', 'very', 'tall', 'She', 'is', 'in', 'the', '9th', 'grade'
		), $factory->wordsSeparate($text));
	}
	
	public function testDefaultTokenizer()
	{
		$factory = new SimHashFactory();
		
		$tokens = $factory->tokenize(array(
			'Mary', 'jane', 'is', 'very', 'tall', 'She', 'is', 'in', 'the', '9th', 'grade'
		));
		
		foreach($tokens as $token)
		{
			$this->assertArrayHasKey('weight', $token);
			$this->assertArrayHasKey('hash', $token);
		}
	}
	
	public function testRun()
	{
		$factory = new SimHashFactory();
		
		$this->assertEquals(
			'11000010101001010010000100101011',
			$factory->run('Mary-jane is very tall. She is in the 9th grade.')->getBin()
		);
	}
	
	public function testCompareEquals()
	{
		$factory = new SimHashFactory();
		
		$hash1 = $factory->run('Mary-jane is very tall. She is in the 9th grade.');
		$hash2 = $factory->run('Mary-jane is very tall. She is in the 9th grade.');
		
		$this->assertEquals(1, $hash1->compareWith($hash2));
	}
	
	public function testCompareSimilar()
	{
		$factory = new SimHashFactory();
		
		$hash1 = $factory->run('Mary-jane is very tall. She was in the 9th grade.');
		$hash2 = $factory->run('Mary-jane is very tall. She is in the 9th grade.');
		
		$this->assertTrue($hash1->compareWith($hash2) < 1);
		$this->assertTrue($hash1->compareWith($hash2) > 0.9);
	}
	
	public function testCompareDifferent()
	{
		$factory = new SimHashFactory();
		
		$hash1 = $factory->run('Mary-jane is very tall. She was in the 9th grade.');
		$hash2 = $factory->run('John is in high school. He is not so tall.');
		
		$this->assertTrue($hash1->compareWith($hash2) < 0.8);
	}
}