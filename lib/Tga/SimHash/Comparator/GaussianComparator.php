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
class GaussianComparator implements ComparatorInterface
{
    /**
     * Expectation of the Gaussian distribution
     *
     * @var int
     */
    protected $deviation;

    /**
     * @param int $deviation
     */
    public function __construct($deviation = 4)
    {
        $this->deviation = $deviation;
    }

    /**
     * Compare the two fingerprints and return a similarity index between 0 and 1.
     *
     * @param Fingerprint $fp1
     * @param Fingerprint $fp2
     * @return float
     */
    public function compare(Fingerprint $fp1, Fingerprint $fp2)
    {
        if ($fp1->getSize() !== $fp2->getSize()) {
            throw new \LogicException(sprintf(
                'The fingerprints passed to the Gaussian comparator have different sizes (%s bits and %s bits).',
                $fp1->getSize(), $fp2->getSize()
            ));
        }

        $countDifferences = substr_count(decbin($fp1->getDecimal() ^ $fp2->getDecimal()), '1');

        return $this->computeSimilarityIndex($countDifferences);
    }


    /**
     * Similarity index
     *
     * @param int $countDifferences
     * @return float
     */
    protected function computeSimilarityIndex($countDifferences)
    {
        return $this->gaussianDensity($countDifferences) / $this->gaussianDensity(0);
    }

    /**
     * Guassian distribution density
     *
     * @param int $x
     * @return float
     */
    protected function gaussianDensity($x)
    {
        $y = - (1 / 2) * pow($x /$this->deviation, 2);
        $y = exp($y);
        $y = (1 / sqrt(2 * pi())) * $y;

        return $y;
    }
}