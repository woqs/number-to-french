<?php

namespace NumberToFrench\Application;

use NumberToFrench\Domain\Hundreds;

class HundredsSerializer
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

    private const DECIMAL_SERIALIZED = [
        '1' => 'dix',
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
        $isOneOnDecimal = false;

        if ($hundreds->getHundred() !== "0") {
            if ($hundreds->getHundred() === "1") {
                $serializedString .= 'cent';
            } else {
                $serializedString .= self::FIGURE_SERIALIZED[$hundreds->getHundred()].'-cent';
            }
        }
        if ($hundreds->getDecimal() !== "0") {
            if ($serializedString !== '') {
                $serializedString .= '-';
            }
            if ($hundreds->getDecimal() === "1") {
                $isOneOnDecimal = true;
            } else {
                $serializedString .= self::DECIMAL_SERIALIZED[$hundreds->getDecimal()];
            }
        }
        if ($hundreds->getBase() !== "0") {
            if ($serializedString !== '') {
                $serializedString .= '-';
            }
            $serializedString .= self::FIGURE_SERIALIZED[$hundreds->getBase()];
        }

        return $serializedString;
    }
}
