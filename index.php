<?php

include 'src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Leg\SimHash\SimHashFactory;

$loader = new UniversalClassLoader();
$loader->registerNamespace('Leg', 'src');
$loader->register();

$simHashFactory = new SimHashFactory();

var_dump($simHashFactory->run('the car is red')->getBinary());