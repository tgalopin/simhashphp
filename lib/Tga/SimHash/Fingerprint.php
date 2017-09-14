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
    protected $value;


    /**
     * Constructor
     *
     * @param int $size
     * @param string $value
     */
    public function __construct($size, $value)
    {
        $this->size = $size;
        $this->value = $value;
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
     * Get the binary value as a string
     *
     * @return string
     */
    public function getBinary()
    {
        return $this->value;
    }

}