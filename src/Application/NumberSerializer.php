<?php

namespace NumberToFrench\Application;

use NumberToFrench\Domain\Number;

class NumberSerializer
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
            // code...
        };
        if ($number->getBase() !== null) {
            $serializedString .= HundredsSerializer::serialize($number->getBase());
        };

        return $serializedString;
    }
}
