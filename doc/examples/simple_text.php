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
$comparator = new Tga\SimHash\Comparator\GaussianComparator(3);

$fp1 = $simhash->hashText($text1);
$fp1 = $simhash->hashText($text2);

var_dump($fp1->getBinary());
var_dump($fp2->getBinary());

// Index between 0 and 1 : 0.80073740291681
var_dump($comparator->compare($fp1, $fp2));