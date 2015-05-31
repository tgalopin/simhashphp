<?php

namespace Tga\SimHash\Extractor;

/**
 * SimpleText extractor testing
 *
 * @author Titouan Galopin <galopintitouan@gmail.com>
 */
class SimpleTextExtractorTest extends \PHPUnit_Framework_TestCase
{
    public function testExtract()
    {
        $extractor = new SimpleTextExtractor();

        static::assertEquals(
            [ 'mary', 'very', 'tall', 'she', 'was', 'the', '9th', 'grade' ],
            $extractor->extract('Mary is very tall. She was in the 9th grade.')
        );
    }
}