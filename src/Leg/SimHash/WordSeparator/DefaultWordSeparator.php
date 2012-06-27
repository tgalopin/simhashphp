<?php

/*
 * This file is part of the SimHashPhp package.
 *
 * (c) Titouan Galopin <http://titouangalopin.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Leg\SimHash\WordSeparator;

/**
 * DefaultWordSeparator
 * 
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
class DefaultWordSeparator implements WordSeparatorInterface
{
	/**
	 * Split the text in words.
	 * 
	 * @param string $text
	 * @return array
	 */
	public function split($text)
	{
		preg_match_all('/\b[a-z0-9]+\b/i', $text, $words);
		
		return $words[0];
	}
}