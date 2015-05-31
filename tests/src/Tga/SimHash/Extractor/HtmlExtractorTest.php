<?php

namespace Tga\SimHash\Extractor;

/**
 * HTML extractor testing
 *
 * @author Titouan Galopin <galopintitouan@gmail.com>
 */
class HtmlExtractorTest extends \PHPUnit_Framework_TestCase
{
    public function testExtract()
    {
        $extractor = new HtmlExtractor();

        static::assertEquals(
            [ 'mary', 'very', 'tall', 'she', 'was', 'the', '9th', 'grade' ],
            $extractor->extract('<html><head><title>Mary is very tall.</title></head><body>She was in the 9th grade.</body></html>')
        );
    }
}