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

use Tga\SimHash\Extractor\HtmlExtractor;
use Tga\SimHash\Extractor\SimpleTextExtractor;

/**
 * @author Titouan Galopin <http://titouangalopin.com/>
 */
class SimHash
{
    const SIMHASH_32 = 32;
    const SIMHASH_64 = 64;
    const SIMHASH_128 = 128;

    /**
     * @var Tokenizer\TokenizerInterface[]
     */
    protected $tokenizers;

    /**
     * @var Vectorizer\VectorizerInterface
     */
    protected $vectorizer;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tokenizers = [
            new Tokenizer\String64Tokenizer(),
            new Tokenizer\String128Tokenizer(),
            new Tokenizer\String32Tokenizer()
        ];

        $this->vectorizer = new Vectorizer\DefaultVectorizer();
    }

    /**
     * Compute the similarity hash on the given HTML document
     *
     * @param string $html
     * @param int $size
     * @return Fingerprint
     */
    public function hashHtml($html, $size = self::SIMHASH_64)
    {
        $extractor = new HtmlExtractor();

        return $this->hash($extractor->extract($html), $size);
    }

    /**
     * Compute the similarity hash on the given text
     *
     * @param string $text
     * @param int $size
     * @return Fingerprint
     */
    public function hashText($text, $size = self::SIMHASH_64)
    {
        $extractor = new SimpleTextExtractor();

        return $this->hash($extractor->extract($text), $size);
    }

    /**
     * Compute the similarity hash on the given elements
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
    public function addTokenizer(Tokenizer\TokenizerInterface $tokenizer)
    {
        $this->tokenizers[] = $tokenizer;
    }

    /**
     * @return Vectorizer\VectorizerInterface
     */
    public function getVectorizer()
    {
        return $this->vectorizer;
    }

    /**
     * @param Vectorizer\VectorizerInterface $vectorizer
     */
    public function setVectorizer(Vectorizer\VectorizerInterface $vectorizer)
    {
        $this->vectorizer = $vectorizer;
    }




    /**
     * Find which tokenizer to use for a given element.
     *
     * @param mixed $element
     * @param int $size
     * @return null|Tokenizer\TokenizerInterface
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
            $availableTokenizers = array_map(function(Tokenizer\TokenizerInterface $tokenizer) {
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