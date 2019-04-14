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
 *
 * @internal
 */
class Fingerprint implements FingerprintInterface
{
    private $size;
    private $decimalValue;

    public function __construct(float $decimalValue, int $size)
    {
        $this->decimalValue = $decimalValue;
        $this->size = $size;
    }

    public function __toString()
    {
        return $this->getBinary();
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getDecimal(): float
    {
        return $this->decimalValue;
    }

    public function getBinary(): string
    {
        return str_pad(decbin($this->decimalValue), $this->size, '0', STR_PAD_LEFT);
    }
}
