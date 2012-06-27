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
		$differences = substr_count(decbin($this->getFingerprint() ^ $otherHash->getFingerprint()), '1');
		$fpLength = strlen((string) decbin($this->getFingerprint()));
		
		return $differences / $fpLength;
	}
	
	public function __toString()
	{
		return $this->getFingerprint();
	}
	
	public function getBinary()
	{
		return decbin($this->getFingerprint());
	}
	
	public function getFingerprint()
	{
		return $this->fingerprint;
	}
}