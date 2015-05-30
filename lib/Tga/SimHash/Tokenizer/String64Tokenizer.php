<?php

/*
 * This file is part of the SimHashPhp package.
 *
 * (c) Titouan Galopin <http://titouangalopin.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tga\SimHash\Tokenizer;

/**
 * Tokenizer for strings that generate 64 bit tokens.
 *
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
class String64Tokenizer implements TokenizerInterface
{
    /**
     * @var array
     */
    private static $crc64Table;


    /**
     * @param string $element
     * @return string
     */
    public function tokenize($element)
    {
        return str_pad(base_convert($this->crc64($element), 16, 2), 64, '0', STR_PAD_LEFT);
    }

    /**
     * Does this tokenizer supports the given element
     *
     * @param string $element
     * @return boolean
     */
    public function supportsElement($element)
    {
        return is_string($element);
    }

    /**
     * Does this tokenizer return tokens of the given size
     *
     * @param int $size
     * @return boolean
     */
    public function supportsSize($size)
    {
        return $size === 64;
    }


    /**
     * Compute the CRC64 algorithm on the given string
     *
     * @param string $string
     * @return string
     */
    private function crc64($string)
    {
        if (self::$crc64Table === null) {
            self::$crc64Table = $this->buildTable();
        }

        $crc = 0;
        $length = strlen($string);

        for ($i = 0; $i < $length; $i++) {
            $crc = self::$crc64Table[($crc ^ ord($string[$i])) & 0xff] ^ (($crc >> 8) & ~(0xff << 56));
        }

        return sprintf('%x', $crc);
    }

    /**
     * Build CRC64 table
     *
     * @return array
     */
    private function buildTable()
    {
        $crc64tab = [];

        // ECMA polynomial
        $poly64rev = (0xC96C5795 << 32) | 0xD7870F42;

        // ISO polynomial
        // $poly64rev = (0xD8 << 56);

        for ($i = 0; $i < 256; $i++)
        {
            for ($part = $i, $bit = 0; $bit < 8; $bit++) {
                if ($part & 1) {
                    $part = (($part >> 1) & ~(0x8 << 60)) ^ $poly64rev;
                } else {
                    $part = ($part >> 1) & ~(0x8 << 60);
                }
            }

            $crc64tab[$i] = $part;
        }

        return $crc64tab;
    }
}