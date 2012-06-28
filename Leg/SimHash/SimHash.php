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
 * A SimHash fingerprint representation
 * 
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
class SimHash
{
	/**
	 * @var long
	 */
	protected $fingerprint;
	
	public function __construct($fingerprint)
	{
		$this->fingerprint = $fingerprint;
	}
	
	public function compareWith(SimHash $otherHash)
	{
		$differences = substr_count(decbin($this->getDec() ^ $otherHash->getDec()), '1');
		$fpLength = strlen((string) decbin($this->getDec())) * 2;
		
		return 1 - ($differences / $fpLength);
	}
	
	public function __toString()
	{
		return $this->getDec();
	}
	
	public function getBin()
	{
		return decbin($this->getDec());
	}
	
	public function getHex()
	{
		return dechex($this->getDec());
	}
	
	public function getDec()
	{
		return $this->fingerprint;
	}
}