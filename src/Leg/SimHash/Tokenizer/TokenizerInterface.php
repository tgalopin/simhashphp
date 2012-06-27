<?php

/*
 * This file is part of the SimHashPhp package.
 *
 * (c) Titouan Galopin <http://titouangalopin.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Leg\SimHash\Tokenizer;

/**
 * TokenizerInterface
 * 
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
interface TokenizerInterface
{
	/**
	 * Tokenize the words array.
	 * 
	 * @param array $words
	 * @return array
	 */
	public function tokenize($words);
	
	/**
	 * Gets the hash method.
	 * 
	 * @return \Closure
	 */
	public function getHashMethod();
	
	/**
	 * Sets the hash method.
	 * 
	 * @param \Closure $method
	 */
	public function setHashMethod(\Closure $method);
}