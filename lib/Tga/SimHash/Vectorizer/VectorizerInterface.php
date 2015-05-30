<?php

/*
 * This file is part of the SimHashPhp package.
 *
 * (c) Titouan Galopin <http://titouangalopin.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tga\SimHash\Vectorizer;

/**
 * A vectorizer is an object able to transform a given list of tokens into a SimHash vector.
 *
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
interface VectorizerInterface
{
    /**
     * @param array $tokens
     * @param int $size
     * @return array
     */
    public function vectorize(array $tokens, $size);
}