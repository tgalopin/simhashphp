SimHashPhp
==========

What is SimHashPhp ?
--------------------

SimHashPhp is a PHP library that port the SimHash algorithm created by Moses Charikar.
This algorithm provide an efficient way to compare two texts or two data sets.

See ["SimHash or the way to compare quickly two datasets"](http://titouangalopin.com/blog/articles/2014/05/simhash-or-the-way-to-compare-quickly-two-datasets)
for more informations.

[![Build Status](https://secure.travis-ci.org/tgalopin/SimHashPhp.png?branch=master)](http://travis-ci.org/tgalopin/SimHashPhp)

How to use it ?
---------------

The library use PSR-0 naming convention so you can easily use it with an autoloader.
However, basically, you can use a simple require:

``` php
<?php

require 'Leg/SimHash/SimHash.php';
require 'Leg/SimHash/SimHashFactory.php';

use Leg\SimHash\SimHash;
use Leg\SimHash\SimHashFactory;


$factory = new SimHashFactory();

$fingerprint1 = $factory->run('Mary-jane is very tall. She was in the 9th grade.');
$fingerprint2 = $factory->run('John is in high school. He is not so tall.');

// This method return a float between 0 and 1
// where 0 is completely different strings and
// 1 is completely equals strings.
$fingerprint1->compareWith($fingerprint2);
```

License
-------

This library is under the MIT license (see LICENSE.md)

About
-----

The SimHashPhp is mainly developed by Titouan Galopin.

Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/tgalopin/SimHashPhp/issues).
