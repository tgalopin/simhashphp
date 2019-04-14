<?php

/*
 * This file is part of the simhashphp project.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\SimHash;

use PHPUnit\Framework\TestCase;
use SimHash\SimHash;

class SimHashTest extends TestCase
{
    public function provideTokensFingerprints()
    {
        yield [
            'tokens' => ['Though', 'yet', 'of', 'Hamlet', 'our', 'dear', 'brother\'s', 'death'],
            'size' => 32,
            'expected' => [
                'size' => 32,
                'decimal' => 1,
                'binary' => '1',
            ],
        ];

        yield [
            'tokens' => ['Though', 'yet', 'of', 'Hamlet', 'our', 'dear', 'brother\'s', 'death'],
            'size' => 128,
            'expected' => [
                'size' => 128,
                'decimal' => 1,
                'binary' => '1',
            ],
        ];

        yield [
            'tokens' => ['Though', 'yet', 'of', 'Hamlet', 'our', 'dear', 'brother\'s', 'death'],
            'size' => 256,
            'expected' => [
                'size' => 256,
                'decimal' => 1,
                'binary' => '1',
            ],
        ];

        yield [
            'tokens' => ['Though', 'yet', 'of', 'Hamlet', 'our', 'dear', 'brother\'s', 'death'],
            'size' => 512,
            'expected' => [
                'size' => 512,
                'decimal' => 1,
                'binary' => '1',
            ],
        ];
    }

    /**
     * @dataProvider provideTokensFingerprints
     */
    public function testCreateFingerprint(array $tokens, int $size, array $expected)
    {
        $simhash = new SimHash();
        $fingerprint = $simhash->createFingerprint($tokens, $size);

        $this->assertSame($expected['size'], $fingerprint->getSize());
        $this->assertSame($expected['decimal'], $fingerprint->getDecimal());
        $this->assertSame($expected['binary'], $fingerprint->getBinary());
    }
}
