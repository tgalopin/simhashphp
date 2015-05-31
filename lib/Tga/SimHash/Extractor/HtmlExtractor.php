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
 * The HTML extractor extract important content from a webpage
 * You can easily extends it to improve or adapt the HTML parsing
 *
 * @author Titouan Galopin <galopintitouan@gmail.com>
 */
class HtmlExtractor extends SimpleTextExtractor
{
    /**
     * Extract the content of a web page
     *
     * @param mixed $html
     * @return array
     */
    public function extract($html)
    {
        $content = '';
        $document = new \DOMDocument();

        try {
            if (! @$document->loadHTML($html)) {
                throw new \RuntimeException();
            }

            // Title
            if ($title = $this->parseTitle($document)) {
                $content .= $title . ' ';
            }
        } catch (\Exception $e) {
            $content = strip_tags($html);
        }

        // Body
        $content .= $this->parseBody($document);

        return parent::extract($content);
    }


    /**
     * Extract the title of the page if it exists
     *
     * @param \DOMDocument $document
     * @return string|false
     */
    protected function parseTitle(\DOMDocument $document)
    {
        $node = $document->getElementsByTagName('title')->item(0);

        if (! $node) {
            return false;
        }

        return $node->nodeValue;
    }

    /**
     * Extract the content of the page if it exists
     *
     * @param \DOMDocument $document
     * @return string|false
     */
    protected function parseBody(\DOMDocument $document)
    {
        // Replace images with their sources
        /** @var \DOMElement[] $images */
        $images = $document->getElementsByTagName('img');

        foreach ($images as $image) {
            $src = 'img' . implode('', parent::extract($image->getAttribute('src')));
            $image->parentNode->replaceChild($document->createElement('span', $src), $image);
        }

        // Extract raw text
        /** @var \DOMElement $node */
        $node = $document->getElementsByTagName('body')->item(0);

        if (! $node) {
            throw new \RuntimeException();
        }

        return $node->nodeValue;
    }
}