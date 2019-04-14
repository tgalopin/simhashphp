<?php

/*
 * This file is part of the simhashphp project.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SimHash;

use SimHash\Hasher\Size128Hasher;
use SimHash\Hasher\Size256Hasher;
use SimHash\Hasher\Size32Hasher;
use SimHash\Hasher\SizeHasherInterface;
use SimHash\Model\FingerprintInterface;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 *
 * @final
 */
class SimHash
{
    /**
     * @var SizeHasherInterface[]
     */
    private $sizeHashers = [];

    /**
     * @param SizeHasherInterface[] $sizeHashers
     */
    public function __construct(array $sizeHashers = null)
    {
        $sizeHashers = $sizeHashers ?: [
            new Size32Hasher(),
            new Size128Hasher(),
            new Size256Hasher(),
        ];

        foreach ($sizeHashers as $hasher) {
            $this->sizeHashers[$hasher->getSize()] = $hasher;
        }
    }

    /**
     * Create a fingerprint for the given array of features.
     *
     * Features are characteristics of the objects your want to compare.
     * SimHash will create close fingerpritns for objects having close features.
     *
     * Features must be strings or castable to strings.
     *
     * @param string[] $features
     * @param int $size
     *
     * @return FingerprintInterface
     */
    public function createFingerprint(array $features, int $size = 128): FingerprintInterface
    {
        if (!isset($this->sizeHashers[$size])) {
            throw new \InvalidArgumentException(sprintf(
                'The SimHash hash size "%s" is not supported (currently supported sizes: %s).',
                $size,
                implode(', ', array_keys($this->sizeHashers))
            ));
        }

        $hashedFeatures = [];
        foreach ($features as $key => $feature) {
            if (!is_string($feature) && (!is_object($feature) || !method_exists($feature, '__toString'))) {
                throw new \InvalidArgumentException(sprintf(
                    'Features must all be strings (given feature with key "%s" is %s).',
                    $key,
                    is_scalar($feature) ? 'a '.gettype($feature) : 'an instance of '.get_class($feature)
                ));
            }

            $hashedFeatures[] = $this->sizeHashers[$size]->hash($feature);
        }

        dump($hashedFeatures);exit;
    }
}
