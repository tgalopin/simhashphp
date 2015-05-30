<?php

require 'vendor/autoload.php';

$simhash = new \Tga\SimHash\SimHash();
$comparator = new \Tga\SimHash\Comparator\GaussianComparator(6);

$fp1 = $simhash->hash(
    [ 'mary-jane', 'is', 'very', 'tall', 'she', 'is', 'in', 'the', '9th', 'grade' ],
    \Tga\SimHash\SimHash::SIMHASH_32
);

$fp2 = $simhash->hash(
    [ 'mary-jane', 'is', 'very', 'tall', 'she', 'was', 'in', 'the', '9th', 'grade' ],
    \Tga\SimHash\SimHash::SIMHASH_32
);

var_dump($comparator->compare($fp1, $fp2));