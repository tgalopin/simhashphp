<?php

/*
 * This file is part of the simhashphp project.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SimHash\Hasher;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 *
 * @internal
 */
trait AlgorithmDetectorHasherTrait
{
    private $algorithm;

    abstract public function getSize(): int;
    abstract public function getPotentialAlgorithms(): array;

    public function hash(string $feature): string
    {
        if (!$this->algorithm) {
            $this->algorithm = $this->detectSupportedAlgorithm();
        }

        return str_pad(base_convert(hash($this->algorithm, $feature), 16, 2), $this->getSize(), '0', STR_PAD_LEFT);
    }

    private function detectSupportedAlgorithm()
    {
        $availableAlgorithms = hash_algos();

        foreach ($this->getPotentialAlgorithms() as $algorithm) {
            if (\in_array($algorithm, $availableAlgorithms, true)) {
                return $algorithm;
            }
        }

        throw new \InvalidArgumentException(sprintf(
            'The SimHash hash size "%s" is supported by the simhashphp library but no supported hash algorithm for that size was found on your system.',
            $this->getSize()
        ));
    }
}
