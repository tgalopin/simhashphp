SimHashPHP
==========

> This is the second version of SimHashPHP. If you are using the version 1 and don't want to
> update your code, please refer to the `1.0-security` branch (https://github.com/tgalopin/SimHashPhp/tree/1.0-security).
> The 1.0 branch will be maintained until the release of a v3 but only the v2 will have lastest features.

What is SimHashPHP ?
--------------------

SimHashPHP is a PHP library that port the SimHash algorithm in PHP.
This algorithm, created by Moses Charikar, provides an efficient way to compute a similarity index between two texts.
It is used by Google internally to detect dupplicate content.

See ["SimHash or the way to compare quickly two datasets"](http://titouangalopin.com/blog/articles/2014/05/simhash-or-the-way-to-compare-quickly-two-datasets)
for more informations.

[![Build Status](https://secure.travis-ci.org/tgalopin/SimHashPhp.png?branch=master)](http://travis-ci.org/tgalopin/SimHashPhp)

How to use it ?
---------------

Install it with [Composer](https://getcomposer.org):

``` sh
composer require tga/simhash-php
```

Once installed, include `vendor/autoload.php` to load the library.

The concept of SimHash is described in [this article](http://titouangalopin.com/blog/articles/2014/05/simhash-or-the-way-to-compare-quickly-two-datasets).
Here are few examples:

``` php
<?php

require 'vendor/autoload.php';

$text1 = <<<EOT
George Headley (1909–1983) was a West Indian cricketer who played 22 Test matches, mostly before the Second World War.
Considered one of the best batsmen to play for West Indies and one of the greatest cricketers of all time, he also
represented Jamaica and played professionally in England. Headley was born in Panama but raised in Jamaica where he
quickly established a cricketing reputation as a batsman. West Indies had a weak cricket team through most of Headley's
career; as their one world-class player, he carried a heavy responsibility, and they depended on his batting. He batted
at number three, scoring 2,190 runs in Tests at an average of 60.83, and 9,921 runs in all first-class matches at an
average of 69.86. He was chosen as one of the Wisden Cricketers of the Year in 1934.
EOT;

$text2 = <<<EOT
George Headley was a West Indian cricketer who played 22 Test matches, mostly before the Second World War.
Considered one of the best batsmen to play for West Indies and one of the greatest cricketers of all time, he also
represented Jamaica and played professionally in England. Headley was born in Panama but raised in Jamaica where he
quickly established a cricketing reputation as a batsman. West Indies had a weak cricket team through most of Headley's
career; as their one world-class player, he carried a heavy responsibility, and they depended on his batting. He batted
at number three, scoring 2,190 runs in tests at an average of 60.83, and 9,921 runs in all first-class matches at an
average of 69.86. He was chosen as one of the Wisden Cricketers of the Year.
EOT;

$simhash = new \Tga\SimHash\SimHash();
$extractor = new \Tga\SimHash\Extractor\SimpleTextExtractor();
$comparator = new Tga\SimHash\Comparator\GaussianComparator(3);

$fp1 = $simhash->hash($extractor->extract($text1), \Tga\SimHash\SimHash::SIMHASH_64);
$fp2 = $simhash->hash($extractor->extract($text2), \Tga\SimHash\SimHash::SIMHASH_64);

var_dump($fp1->getBinary());
var_dump($fp2->getBinary());

// Index between 0 and 1 : 0.80073740291681
var_dump($comparator->compare($fp1, $fp2));
```

License
-------

This library is under the MIT license (see LICENSE.md)

About
-----

SimHashPHP is mainly developed by Titouan Galopin.

Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/tgalopin/SimHashPhp/issues).
