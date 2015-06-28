<?php

/*
 * This file is part of the SimHashPhp package.
 *
 * (c) Titouan Galopin <http://titouangalopin.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tga\SimHash;

use Tga\SimHash\Comparator\GaussianComparator;
use Tga\SimHash\Extractor\SimpleTextExtractor;

/**
 * SimHash functional tests
 *
 * @author Titouan Galopin <galopintitouan@gmail.com>
 */
class SimHashTest extends \PHPUnit_Framework_TestCase
{
    public function testDifferentTexts()
    {
        $text1 = file_get_contents(__DIR__ . '/../../../resources/text/file1.txt');
        $text2 = file_get_contents(__DIR__ . '/../../../resources/text/file3.txt');

        $simhash = new SimHash();
        $extractor = new SimpleTextExtractor();
        $comparator = new GaussianComparator();

        $fp1 = $simhash->hash($extractor->extract($text1));
        $fp2 = $simhash->hash($extractor->extract($text2));

        self::assertLessThan(0.1, $comparator->compare($fp1, $fp2));
    }

    public function testSimilarTexts()
    {
        $text1 = file_get_contents(__DIR__ . '/../../../resources/text/file1.txt');
        $text2 = file_get_contents(__DIR__ . '/../../../resources/text/file2.txt');

        $simhash = new SimHash();
        $extractor = new SimpleTextExtractor();
        $comparator = new GaussianComparator();

        $fp1 = $simhash->hash($extractor->extract($text1));
        $fp2 = $simhash->hash($extractor->extract($text2));

        self::assertLessThan(0.9, $comparator->compare($fp1, $fp2));
        self::assertGreaterThan(0.1, $comparator->compare($fp1, $fp2));
    }

    public function testEqualTexts()
    {
        $text1 = file_get_contents(__DIR__ . '/../../../resources/text/file1.txt');
        $text2 = file_get_contents(__DIR__ . '/../../../resources/text/file1.txt');

        $simhash = new SimHash();
        $extractor = new SimpleTextExtractor();
        $comparator = new GaussianComparator();

        $fp1 = $simhash->hash($extractor->extract($text1));
        $fp2 = $simhash->hash($extractor->extract($text2));

        self::assertEquals(1, $comparator->compare($fp1, $fp2));
    }
}