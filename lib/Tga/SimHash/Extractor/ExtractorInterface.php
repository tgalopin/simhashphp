<?php

/*
 * This file is part of the SimHashPhp package.
 *
 * (c) Titouan Galopin <http://titouangalopin.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tga\SimHash\Extractor;

/**
 * An extractor is an object able to extract important content information from a given set of elements.
 *
 * @author Titouan Galopin <galopintitouan@gmail.com>
 */
interface ExtractorInterface
{
    /**
     * Extract the important information from the input and return an array
     * of elements to use in SimHash
     *
     * @param mixed $input
     * @return array
     */
    public function extract($input);
}