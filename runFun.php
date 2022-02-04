<?php

$inputValues = require_once __DIR__ . '/inputValues.php';
array_walk($inputValues, 'intval');

const FIGURE_SERIALIZED = [
    '1' => 'un',
    '2' => 'deux',
    '3' => 'trois',
    '4' => 'quatre',
    '5' => 'cinq',
    '6' => 'six',
    '7' => 'sept',
    '8' => 'huit',
    '9' => 'neuf',
];

const ODD_SERIALIZED = [
    '0' => 'dix',
    '1' => 'onze',
    '2' => 'douze',
    '3' => 'treize',
    '4' => 'quatorze',
    '5' => 'quinze',
    '6' => 'seize',
    '7' => 'dix-sept',
    '8' => 'dix-huit',
    '9' => 'dix-neuf',
];

const DECIMAL_SERIALIZED = [
    '2' => 'vingt',
    '3' => 'trente',
    '4' => 'quarante',
    '5' => 'cinquante',
    '6' => 'soixante',
    '7' => 'soixante',
    '8' => 'quatre-vingt',
    '9' => 'quatre-vingt',
];


function dealWithGroupOfThreeish($groupOfThreeish, $isThousands = false, $isLast = false) {
    $baseGroupOfThreeish = $groupOfThreeish;
    $previousContent = false;
    $isDoubleZeroStart = substr($groupOfThreeish, 0, 2) === "00";
    if ($isThousands && $groupOfThreeish === "1") return false;
    while (strlen($groupOfThreeish) > 0) {
        if ($groupOfThreeish[0] !== "0")
            switch(strlen($groupOfThreeish)) {
                case 3:
                    if (isset($groupOfThreeish[0]) && $groupOfThreeish[0] !== "1") {
                        echo FIGURE_SERIALIZED[$groupOfThreeish[0]] . "-";
                    }
                    echo "cent";
                    break;
                case 2:
                    if ($previousContent && $previousContent !== "0") echo "-";
                    if ($groupOfThreeish[0] !== "1") echo DECIMAL_SERIALIZED[$groupOfThreeish[0]];
                    break;
                case 1:
                    if ($groupOfThreeish[0] === "1" &&
                        $previousContent !== false &&
                        $previousContent !== "0" &&
                        $previousContent !== "1" &&
                        $previousContent !== "8" &&
                        $previousContent !== "9"
                    ) echo "-et";
                    if ($previousContent !== "1" &&
                        $previousContent !== "7" &&
                        $previousContent !== "9"
                    ) {
                        if ($previousContent !== false && !$isDoubleZeroStart) echo "-";
                        echo FIGURE_SERIALIZED[$groupOfThreeish[0]];
                    } else {
                        if ($previousContent !== "1") echo "-";
                        echo ODD_SERIALIZED[$groupOfThreeish[0]];
                    }
                    break;
            }
        else if (strlen($groupOfThreeish) === 1 &&
            ($previousContent === "1" || $previousContent === "7" || $previousContent === "9")
        ) {
            if ($previousContent !== "1") echo "-";
            if ($previousContent !== "0") echo ODD_SERIALIZED[$groupOfThreeish[0]];
            break;
        }
        $previousContent = $groupOfThreeish[0];
        $groupOfThreeish = substr($groupOfThreeish, 1);
    }

    if ($isLast && (
            substr($baseGroupOfThreeish, -2) === "80" ||
            (substr($baseGroupOfThreeish, -2) === "00" && $baseGroupOfThreeish !== "100" && $baseGroupOfThreeish !== "000")
        )
    ) {
        echo "s";
    }
}


foreach ($inputValues as $integerToTranslate) {
    preg_match('/(\d{1,3})(\d{1,3})?(\d{1,3})?(\d{1,3})?/', strrev((string)$integerToTranslate), $matches);
    for ($i=count($matches)-1; $i > 0; $i--) {
        $groupOfThreeish = strrev($matches[$i]);
        switch ($i) {
            case 1:
                if ($groupOfThreeish === "0") {
                    echo "zéro";
                    break;
                }
                if (count($matches) > 2 && $groupOfThreeish !== "000") echo "-";
                dealWithGroupOfThreeish($groupOfThreeish, false, true);
                if ($groupOfThreeish === "000" && $matches[$i+1] !== "1") echo "s";
                break;
            case 2:
                dealWithGroupOfThreeish($groupOfThreeish, true);
                if ($groupOfThreeish !== "1") echo "-";
                echo "mille";
                break;
            case 3:
                dealWithGroupOfThreeish($groupOfThreeish);
                echo "-million";
                break;
            case 4:
                dealWithGroupOfThreeish($groupOfThreeish);
                echo "-milliard";
                break;
        }
        if ($matches[$i] !== "1" && ($i === 3 || $i === 4)) {
            echo "s";
        }
    }
    echo "\n";
}
