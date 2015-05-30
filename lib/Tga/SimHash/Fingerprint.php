<?php

/*
 * This file is part of the SimHashPhp package.
 *
 * (c) Titouan Galopin <http://titouangalopin.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tga\SimHash;

/**
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
class Fingerprint
{
    /**
     * @var int
     */
    protected $size;

    /**
     * @var float
     */
    protected $decimalValue;


    /**
     * Constructor
     *
     * @param int $size
     * @param float $decimalValue
     */
    public function __construct($size, $decimalValue)
    {
        $this->size = $size;
        $this->decimalValue = (float) $decimalValue;
    }

    /**
     * Display the binary value by default
     */
    public function __toString()
    {
        return $this->getBinary();
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get the decimal value
     *
     * @return float
     */
    public function getDecimal()
    {
        return $this->decimalValue;
    }

    /**
     * Get the binary value as a string
     *
     * @return string
     */
    public function getBinary()
    {
        return str_pad(decbin($this->decimalValue), $this->size, '0', STR_PAD_LEFT);
    }

    /**
     * Get the hexadecimal value as a string
     *
     * @return string
     */
    public function getHexa()
    {
        return dechex($this->decimalValue);
    }
}