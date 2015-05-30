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
 * A tokenizer is an object able to create a token of a constant length using a given element
 *
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
interface TokenizerInterface
{
    /**
     * Tokenize the given element and return the binary representation as a string of the token
     *
     * @param mixed $element
     * @return string
     */
    public function tokenize($element);

    /**
     * Does this tokenizer supports the given element
     *
     * @param mixed $element
     * @return boolean
     */
    public function supportsElement($element);

    /**
     * Does this tokenizer return tokens of the given size
     *
     * @param int $size
     * @return boolean
     */
    public function supportsSize($size);
}