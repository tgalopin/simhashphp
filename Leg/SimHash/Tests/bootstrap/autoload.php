<?php

/*
 * This file is part of the SimHashPhp package.
 *
 * (c) Titouan Galopin <http://titouangalopin.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

include __DIR__.'/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Leg\SimHash\SimHashFactory;

$loader = new UniversalClassLoader();
$loader->registerNamespace('Leg', __DIR__.'/../../../..');
$loader->register();

$simHashFactory = new SimHashFactory();