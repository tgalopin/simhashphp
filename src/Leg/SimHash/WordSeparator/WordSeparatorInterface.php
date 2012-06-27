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
 * WordSeparatorInterface
 * 
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
interface WordSeparatorInterface
{
	/**
	 * Split the text in words.
	 * 
	 * @param string $text
	 * @return array
	 */
	public function split($text);
}