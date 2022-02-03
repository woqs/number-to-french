<?php

namespace NumberToFrench\Application;

use NumberToFrench\Domain\Number;

class NumberSerializer extends AbstractSerializer
{
    public static function serialize(Number $number): string
    {
        $serializedString = '';
        if ($number->getBillion() !== null) {
            $serializedString;
        };
        if ($number->getMillion() !== null) {
            // code...
        };
        if ($number->getThousand() !== null) {
            $serializedString = self::addPrefixDash($serializedString);
            $serializedString .= HundredsSerializer::serialize($number->getThousand());
            if ($serializedString === "un") {
                $serializedString = "";
            }
            $serializedString = self::addPrefixDash($serializedString);
            $serializedString .= "mille";
        };
        if ($number->getBase() !== null) {
            if ($number->getBase()->getBase() === "0" &&
                $number->getBase()->getDecimal() === "0" &&
                $number->getBase()->getHundred() === "0"
            ) {
                // break
            } else {
                $serializedString = self::addPrefixDash($serializedString);
                $serializedString .= HundredsSerializer::serialize($number->getBase());
            }
        };

        if ($serializedString === '') {
            $serializedString = "zéro";
        }

        return $serializedString;
    }
}
