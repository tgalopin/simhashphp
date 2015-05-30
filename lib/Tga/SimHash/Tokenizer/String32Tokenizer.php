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
 * Tokenizer for strings that generate 32 bit tokens.
 *
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
class String32Tokenizer implements TokenizerInterface
{
    /**
     * @param string $element
     * @return string
     */
    public function tokenize($element)
    {
        return str_pad(base_convert(hash('crc32b', $element), 16, 2), 32, '0', STR_PAD_LEFT);
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
        return $size === 32;
    }
}