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
            [ 'mary', 'is', 'very', 'tall', 'she', 'was', 'in', 'the', '9th', 'grade' ],
            $extractor->extract('Mary is very tall. She was in the 9th grade.')
        );
    }
}