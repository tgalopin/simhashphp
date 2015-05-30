<?php

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