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

use Leg\SimHash\Tokenizer\DefaultTokenizer;

use Leg\SimHash\WordSeparator\DefaultWordSeparator;

use Leg\SimHash\WordSeparator\WordSeparatorInterface;
use Leg\SimHash\Tokenizer\TokenizerInterface;

class SimHashFactory
{
	/**
	 * @var integer
	 */
	protected $hash_size;
	
	/**
	 * @var \Leg\SimHash\WordSeparator\WordSeparatorInterface
	 */
	protected $words_separator;
	
	/**
	 * @var \Leg\SimHash\Tokenizer\TokenizerInterface
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
		$this->hash_size = $hash_size;
		
		$this->words_separator = new DefaultWordSeparator();
		$this->tokenizer = new DefaultTokenizer();
	}
	
	/**
	 * Run the factory
	 * 
	 * @param string $str
	 * @return SimHash
	 */
	public function run($str)
	{
		return $this->runWithWords($this->words_separator->split($str));
	}
	
	/**
	 * Run the factory with words
	 *
	 * @param array $words
	 * @return SimHash
	 */
	public function runWithWords(array $words)
	{
		return $this->runWithTokens($this->tokenizer->tokenize($words));
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
	    return $this->hash_size;
	}
	
	/**
	 * Set the hash size
	 *
	 * @param integer $hash_size
	 */
	public function setHashSize($hash_size)
	{
	    $this->hash_size = $hash_size;
	}

	/**
	 * @return \Leg\SimHash\WordSeparator\WordSeparatorInterface
	 */
	public function getWordsSeparator()
	{
	    return $this->words_separator;
	}
	
	/**
	 * @param \Leg\SimHash\WordSeparator\WordSeparatorInterface $words_separator
	 */
	public function setWordsSeparator(WordSeparatorInterface $words_separator)
	{
	    $this->words_separator = $words_separator;
	}
	
	/**
	 * @return \Leg\SimHash\Tokenizer\TokenizerInterface
	 */
	public function getTokenizer()
	{
	    return $this->tokenizer;
	}
	
	/**
	 * @param \Leg\SimHash\Tokenizer\TokenizerInterface $tokenizer
	 */
	public function setTokenizer(TokenizerInterface $tokenizer)
	{
	    $this->tokenizer = $tokenizer;
	}
	
	protected function vectorize($tokens)
	{
		$vector = array_fill(0, $this->hash_size, 0);
		
		foreach($tokens as $key => $value)
		{
			for ($i = 0; $i < $this->hash_size; $i++)
			{
				if ($value['hash'][$i] == 1)
					$vector[$i] = intval($vector[$i]) + intval($value['weight']);
				else
					$vector[$i] = intval($vector[$i]) - intval($value['weight']);
			}
		}
		
		return $vector;
	}
	
	protected function fingerprint($vector)
	{
		$fingerprint = str_pad('', $this->hash_size, '0');
		
		for ($i = 0; $i < $this->hash_size; $i++)
		{
			if ($vector[$i] >= 0) $fingerprint[$i] = '1';
		}
		
		return bindec($fingerprint);
	}
	
	protected function hexbin($str_hex)
	{
		
	}
}