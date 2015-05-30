<?php

/*
 * This file is part of the SimHashPhp package.
 *
 * (c) Titouan Galopin <http://titouangalopin.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tga\SimHash\Vectorizer;

/**
 * The default vectorizer
 *
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
class DefaultVectorizer implements VectorizerInterface
{
    /**
     * @param array $tokens
     * @param int $size
     * @return array
     */
    public function vectorize(array $tokens, $size)
    {
        $weightTokens = $this->createWeightTokens($tokens);
        $vector = array_fill(0, $size, 0);

        foreach ($weightTokens as $token => $weight) {
            for ($i = 0; $i < $size; $i++) {
                if ($token[$i] === '1') {
                    $vector[$i] += (int) $weight;
                } else {
                    $vector[$i] -= (int) $weight;
                }
            }
        }

        return $vector;
    }

    /**
     * Create a tokens list using weights to ponder tokens importance
     *
     * @param array $tokens
     * @return array
     */
    protected function createWeightTokens($tokens)
    {
        $weightTokens = [];

        foreach ($tokens as $token) {
            if (! array_key_exists($token, $weightTokens)) {
                $weightTokens[$token] = 1;
            } else {
                $weightTokens[$token]++;
            }
        }

        return $weightTokens;
    }
}