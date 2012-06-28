<?php

/*
 * This file is part of the SimHashPhp package.
 *
 * (c) Titouan Galopin <http://titouangalopin.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Leg\SimHash;

/**
 * The SimHash fingerprints factory
 * 
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
class SimHashFactory
{
	/**
	 * @var integer
	 */
	protected $hashSize;
	
	/**
	 * @var \Closure
	 */
	protected $wordsSeparator;
	
	/**
	 * @var \Closure
	 */
	protected $tokenizer;
	
	/**
	 * Constructor
	 * 
	 * @param integer $hash_size
	 * @param string $hash_method
	 * @throws \InvalidArgumentException
	 */
	public function __construct($hash_size = 32)
	{
		$this->hashSize = $hash_size;
		
		$this->wordsSeparator = function ($text)
		{
			preg_match_all('/\b[a-z0-9]+\b/i', $text, $words);
			
			return $words[0];
		};
		
		$this->tokenizer = function ($words)
		{
			$tokens = array();
			
			$hash_method = function ($str)
			{
				$str_hex = md5($str);
				$str_bin = '';
				
				for ($i = 0; $i < strlen($str_hex); $i++)
				{
					$str_bin .= sprintf('%04s', decbin(hexdec($str_hex[$i])));
				}
				
				return (!empty($str_bin)) ? $str_bin : false;
			};
			
			foreach (array_count_values($words) as $key => $weight)
			{
				$tokens[$key]['weight'] = $weight;
				$tokens[$key]['hash'] = $hash_method($key);
			}
			
			return $tokens;
		};
	}
	
	/**
	 * Run the factory
	 * 
	 * @param string $str
	 * @return SimHash
	 */
	public function run($str)
	{
		return $this->runWithWords($this->wordsSeparate($str));
	}
	
	/**
	 * Run the factory with words
	 *
	 * @param array $words
	 * @return SimHash
	 */
	public function runWithWords(array $words)
	{
		return $this->runWithTokens($this->tokenize($words));
	}
	
	/**
	 * Run the factory with tokens
	 *
	 * @param array $tokens
	 * @return SimHash
	 */
	public function runWithTokens(array $tokens)
	{
		return new SimHash($this->fingerprint($this->vectorize($tokens)));
	}

	/**
	 * Get the hash size
	 * 
	 * @return integer
	 */
	public function getHashSize()
	{
	    return $this->hashSize;
	}
	
	/**
	 * Set the hash size
	 *
	 * @param integer $hash_size
	 */
	public function setHashSize($hash_size)
	{
	    $this->hashSize = $hash_size;
	}

	/**
	 * Separate the words
	 * 
	 * @param string $text
	 * @return array
	 */
	public function wordsSeparate($text)
	{
		$method = $this->wordsSeparator;
		
	    return $method($text);
	}

	/**
	 * Set the words separator method
	 * 
	 * @param \Closure $wordsSeparator
	 */
	public function setWordsSeparator(\Closure $wordsSeparator)
	{
	    $this->wordsSeparator = $wordsSeparator;
	}

	/**
	 * Tokenize the words
	 * 
	 * @param array $words
	 * @return array
	 */
	public function tokenize(array $words)
	{
	    $method = $this->tokenizer;
	    
	    return $method($words);
	}

	/**
	 * Set the tokenizer method
	 * 
	 * @param \Closure $tokenizer
	 */
	public function setTokenizer(\Closure $tokenizer)
	{
	    $this->tokenizer = $tokenizer;
	}
	
	/**
	 * Create the vector with the tokens
	 * 
	 * @param array $tokens
	 * @return array
	 */
	protected function vectorize(array $tokens)
	{
		$vector = array_fill(0, $this->hashSize, 0);
		
		foreach($tokens as $key => $value)
		{
			for ($i = 0; $i < $this->hashSize; $i++)
			{
				if ($value['hash'][$i] == 1)
					$vector[$i] = intval($vector[$i]) + intval($value['weight']);
				else
					$vector[$i] = intval($vector[$i]) - intval($value['weight']);
			}
		}
		
		return $vector;
	}
	
	/**
	 * Create the fingerprint from the vector
	 * 
	 * @param array $vector
	 * @return number
	 */
	protected function fingerprint(array $vector)
	{
		$fingerprint = str_pad('', $this->hashSize, '0');
		
		for ($i = 0; $i < $this->hashSize; $i++)
		{
			if ($vector[$i] >= 0) $fingerprint[$i] = '1';
		}
		
		return bindec($fingerprint);
	}
}