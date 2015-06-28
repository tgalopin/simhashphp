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

use Cocur\Slugify\Slugify;

/**
 * The SimpleText extractor provides an easy way to split a classic text in words in order to compute
 * a similarity hash on this text
 *
 * @author Titouan Galopin <galopintitouan@gmail.com>
 */
class SimpleTextExtractor implements ExtractorInterface
{
    /**
     * Extract the words of the text
     *
     * @param mixed $text
     * @return array
     */
    public function extract($text)
    {
        $slugify = new Slugify();
        $slugifiedText = $slugify->slugify($text);

        return explode('-', $slugifiedText);
    }
}