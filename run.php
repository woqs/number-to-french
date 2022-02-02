<?php

$inputValues = require_once __DIR__ . '/inputValues.php';
$loader = require_once __DIR__ . '/vendor/autoload.php';

use NumberToFrench\FromNumberToFrenchStringHandler;

array_walk($inputValues, 'intval');

$handler = new FromNumberToFrenchStringHandler();
foreach ($handler->handle($inputValues) as $translatedNumber) {
    print($translatedNumber . "\n");
}
