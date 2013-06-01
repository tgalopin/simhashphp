SimHashPhp
==========

What is SimHashPhp ?
--------------------

SimHashPhp is a PHP library that port the SimHash algorithm created by Moses Charikar.
This algorithm provide an efficient way to compare two texts or two data sets.

[![Build Status](https://secure.travis-ci.org/tgalopin/SimHashPhp.png?branch=master)](http://travis-ci.org/tgalopin/SimHashPhp)

How to use it ?
---------------

``` php
<?php

$factory = new SimHashFactory();

$hash1 = $factory->run('Mary-jane is very tall. She was in the 9th grade.');
$hash2 = $factory->run('John is in high school. He is not so tall.');

// This method return a float between 0 and 1
// where 0 is completely different strings and
// 1 is completely equals strings.
$hash1->compareWith($hash2);
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