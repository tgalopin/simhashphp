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
class Size32Hasher implements SizeHasherInterface
{
    use AlgorithmDetectorHasherTrait;

    public function getSize(): int
    {
        return 32;
    }

    public function getPotentialAlgorithms(): array
    {
        return ['crc32b', 'crc32', 'adler32'];
    }
}
