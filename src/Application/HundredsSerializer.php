<?php

namespace NumberToFrench\Application;

use NumberToFrench\Domain\Hundreds;

class HundredsSerializer extends AbstractSerializer
{
    private const FIGURE_SERIALIZED = [
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

    private const ODD_SERIALIZED = [
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

    private const DECIMAL_SERIALIZED = [
        '2' => 'vingt',
        '3' => 'trente',
        '4' => 'quarante',
        '5' => 'cinquante',
        '6' => 'soixante',
        '7' => 'soixante',
        '8' => 'quatre-vingt',
        '9' => 'quatre-vingt',
    ];

    public static function serialize(Hundreds $hundreds)
    {
        $serializedString = '';
        $isOddNumber = false;

        if ($hundreds->getHundred() !== "0") {
            if ($hundreds->getHundred() === "1") {
                $serializedString .= 'cent';
            } else {
                $serializedString .= self::FIGURE_SERIALIZED[$hundreds->getHundred()].'-cent';
            }
        }
        if ($hundreds->getDecimal() !== "0") {
            switch ($hundreds->getDecimal()) {
                case "1":
                    $isOddNumber = true;
                    break;
                case "7":
                case "9":
                    $isOddNumber = true;
                default:
                    $serializedString = self::addPrefixDash($serializedString);
                    $serializedString .= self::DECIMAL_SERIALIZED[$hundreds->getDecimal()];
                    break;
            }
        }
        if ($hundreds->getBase() !== "0" || $isOddNumber) {
            $serializedString = self::addPrefixDash($serializedString);
            if ($hundreds->getDecimal() !== "0" &&
                $hundreds->getDecimal() !== "1" &&
                $hundreds->getDecimal() !== "8" &&
                $hundreds->getDecimal() !== "9" &&
                $hundreds->getBase() === "1"
            ) {
                $serializedString .= 'et-';
            }
            if ($isOddNumber) {
                $serializedString .= self::ODD_SERIALIZED[$hundreds->getBase()];
            } else {
                $serializedString .= self::FIGURE_SERIALIZED[$hundreds->getBase()];
            }
        }

        return $serializedString;
    }
}
