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

use Tga\SimHash\Tokenizer\String32Tokenizer;
use Tga\SimHash\Tokenizer\String64Tokenizer;
use Tga\SimHash\Tokenizer\TokenizerInterface;
use Tga\SimHash\Vectorizer\DefaultVectorizer;
use Tga\SimHash\Vectorizer\VectorizerInterface;

/**
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
class SimHash
{
    const SIMHASH_32 = 32;
    const SIMHASH_64 = 64;

    /**
     * @var TokenizerInterface[]
     */
    protected $tokenizers;

    /**
     * @var VectorizerInterface
     */
    protected $vectorizer;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tokenizers = [
            new String64Tokenizer(),
            new String32Tokenizer()
        ];

        $this->vectorizer = new DefaultVectorizer();
    }

    /**
     * Compute the similarity hash on the given element
     *
     * @param array $elements
     * @param int $size
     * @return Fingerprint
     */
    public function hash($elements, $size = self::SIMHASH_64)
    {
        $tokens = [];

        // Tokenize elements
        foreach ($elements as $element) {
            $tokens[] = $this->findTokenizer($element, $size)->tokenize($element);
        }

        // Vectorize elements
        $vector = $this->vectorizer->vectorize($tokens, $size);

        // Create the fingerprint with the vector
        $fingerprint = array_fill(0, $size, 0);

        for ($i = 0; $i < $size; $i++) {
            if ($vector[$i] >= 0) {
                $fingerprint[$i] = 1;
            }
        }

        return new Fingerprint($size, bindec(implode('', $fingerprint)));
    }

    /**
     * @return Tokenizer\TokenizerInterface[]
     */
    public function getTokenizers()
    {
        return $this->tokenizers;
    }

    /**
     * @param Tokenizer\TokenizerInterface $tokenizer
     */
    public function addTokenizer(TokenizerInterface $tokenizer)
    {
        $this->tokenizers[] = $tokenizer;
    }

    /**
     * @return VectorizerInterface
     */
    public function getVectorizer()
    {
        return $this->vectorizer;
    }

    /**
     * @param VectorizerInterface $vectorizer
     */
    public function setVectorizer(VectorizerInterface $vectorizer)
    {
        $this->vectorizer = $vectorizer;
    }




    /**
     * Find which tokenizer to use for a given element.
     *
     * @param mixed $element
     * @param int $size
     * @return null|TokenizerInterface
     */
    protected function findTokenizer($element, $size)
    {
        $tokenizer = null;

        foreach ($this->tokenizers as $t) {
            if ($t->supportsElement($element) && $t->supportsSize($size)) {
                $tokenizer = $t;
                break;
            }
        }

        if (! $tokenizer) {
            $availableTokenizers = array_map(function(TokenizerInterface $tokenizer) {
                return str_replace('Tga\\SimHash\\Tokenizer\\', '', get_class($tokenizer));
            }, $this->tokenizers);

            throw new \RuntimeException(sprintf(
                'No tokenizer is able to tokenize "%s" in %s bits (available tokenizers: %s)',
                is_object($element) ? 'instance of ' . get_class($element) : gettype($element),
                $size,
                implode(', ', $availableTokenizers)
            ));
        }

        return $tokenizer;
    }
}