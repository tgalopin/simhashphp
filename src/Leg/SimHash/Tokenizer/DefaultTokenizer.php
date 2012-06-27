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
 * DefaultTokenizer
 * 
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
class DefaultTokenizer implements TokenizerInterface
{
	/**
	 * @var \Closure
	 */
	protected $hash_method;
	
	public function __construct()
	{
		$this->hash_method = function ($str) {
			$str_hex = md5($str);
			$str_bin = '';
			
			for ($i = 0; $i < strlen($str_hex); $i++)
			{
				$str_bin .= sprintf('%04s', decbin(hexdec($str_hex[$i])));
			}
			
			return (!empty($str_bin)) ? $str_bin : false;
		};
	}
	
	/**
	 * Tokenize the words array.
	 * 
	 * @param array $words
	 * @return array
	 */
	public function tokenize($words)
	{
		$tokens = array();
		$hash_method = $this->hash_method;
	
		foreach (array_count_values($words) as $key => $weight)
		{
			$tokens[$key]['weight'] = $weight;
			$tokens[$key]['hash'] = $hash_method($key);
		}
		
		return $tokens;
	}
	
	/**
	 * Gets the hash method.
	 * 
	 * @return \Closure
	 */
	public function getHashMethod()
	{
		return $this->hash_method;
	}
	
	/**
	 * Sets the hash method.
	 * 
	 * @param \Closure $method
	 */
	public function setHashMethod(\Closure $method)
	{
		$this->hash_method = $method;
	}
}