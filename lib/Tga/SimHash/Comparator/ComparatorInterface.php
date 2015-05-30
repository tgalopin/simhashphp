<?php

/*
 * This file is part of the SimHashPhp package.
 *
 * (c) Titouan Galopin <http://titouangalopin.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tga\SimHash\Comparator;

use Tga\SimHash\Fingerprint;

/**
 * A comparator is an object able to compare two fingerprints.
 *
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
interface ComparatorInterface
{
    /**
     * Compare the two fingerprints and return a similarity index between 0 and 1.
     *
     * @param Fingerprint $fp1
     * @param Fingerprint $fp2
     * @return float
     */
    public function compare(Fingerprint $fp1, Fingerprint $fp2);
}