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
 * Tokenizer for strings that generate 512 bit tokens.
 *
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
class String512Tokenizer implements TokenizerInterface
{
 
    protected static $search = array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f');
    protected static $replace = array('0000','0001','0010','0011','0100','0101','0110','0111','1000','1001','1010','1011','1100','1101','1110','1111');
    
    /**
     * @param string $element
     * @return string
     */
    public function tokenize($element)
    {
        $hash = hash('sha512', $element);
        $hash = str_replace(self::$search, self::$replace, $hash);
        $hash = str_pad($hash, 512, '0', STR_PAD_LEFT);
        return $hash;
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
        return $size === 512;
    }
}
