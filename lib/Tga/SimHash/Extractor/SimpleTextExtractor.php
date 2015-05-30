<?php

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

        $words = explode('-', $slugifiedText);
        $content = [];

        foreach ($words as $word) {
            if (strlen($word) > 2) {
                $content[] = $word;
            }
        }

        return $content;
    }
}