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
 * A size hasher is able to hash tokens to as certain hash size.
 *
 * @author Titouan Galopin <galopintitouan@gmail.com>
 *
 * @internal
 */
interface SizeHasherInterface
{
    /**
     * The size of hashes this hasher will return.
     *
     * @return int
     */
    public function getSize(): int;

    /**
     * Hash a given feature to the size of this hasher.
     *
     * @param string $feature
     *
     * @return string
     */
    public function hash(string $feature): string;
}
