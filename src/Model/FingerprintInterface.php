<?php

/*
 * This file is part of the flysystem-bundle project.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SimHash\Model;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 */
interface FingerprintInterface
{
    public function getSize(): int;
    public function getDecimal(): float;
    public function getBinary(): string;
}
