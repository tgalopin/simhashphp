SimHashPhp
==========

> This is the second version of SimHashPhp. If you are using the version 1 and don't want to
> update your code, please refer to the `1.0-security` branch (https://github.com/tgalopin/SimHashPhp/tree/1.0-security).
> The 1.0 branch will be maintained until the release of a v3 but only the v2 will have lastest features.

What is SimHashPhp ?
--------------------

SimHashPhp is a PHP library that port the SimHash algorithm in PHP.
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

$factory = new Tga\SimHash\SimHashFactory();

$fingerprint1 = $factory->run('Mary-jane is very tall. She was in the 9th grade.');
$fingerprint2 = $factory->run('John is in high school. He is not so tall.');

// This method return a float between 0 and 1
// where 0 is completely different strings and
// 1 is completely equals strings.
$fingerprint1->compareWith($fingerprint2);

// Return the binary value of the fingerprint (as a string)
$fingerprint->getBin();

// Return the decimal value of the fingerprint (to store and compare in a database)
$fingerprint->getDec();

// Return the hexadecimal value of the fingerprint (to store and compare in a database)
$fingerprint->getHex();
```

License
-------

This library is under the MIT license (see LICENSE.md)

About
-----

SimHashPhp is mainly developed by Titouan Galopin.

Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/tgalopin/SimHashPhp/issues).
