<?php

namespace NumberToFrench\Application;

use NumberToFrench\Domain\Hundreds;
use NumberToFrench\Domain\Number;

class NumberSerializer extends AbstractSerializer
{
    public static function serialize(Number $number): string
    {
        $serializedString = '';

        if ($number->getBillion() !== null) {
            if (self::shouldPass($number->getBillion())) {
                // break
            } else {
                $serializedString = self::addPrefixDash($serializedString);
                $serializedString .= HundredsSerializer::serialize($number->getBillion());
                $serializedString = self::addPrefixDash($serializedString);
                if ($serializedString === "un") {
                    $serializedString .= "milliard";
                } else {
                    $serializedString .= "milliards";
                }
            }
        }
        if ($number->getMillion() !== null) {
            if (self::shouldPass($number->getMillion())) {
                // break
            } else {
                $serializedString = self::addPrefixDash($serializedString);
                $serializedString .= HundredsSerializer::serialize($number->getMillion());
                $serializedString = self::addPrefixDash($serializedString);
                if ($serializedString === "un") {
                    $serializedString .= "million";
                } else {
                    $serializedString .= "millions";
                }
            }
        }
        if ($number->getThousand() !== null) {
            if (self::shouldPass($number->getThousand())) {
                // break
            } else {
                $serializedString = self::addPrefixDash($serializedString);
                $serializedString .= HundredsSerializer::serialize($number->getThousand());
                if ($serializedString === "un") {
                    $serializedString = "";
                }
                $serializedString = self::addPrefixDash($serializedString);
                $serializedString .= "mille";
            }
        }
        if ($number->getBase() !== null) {
            if (self::shouldPass($number->getBase())) {
                // break
            } else {
                $serializedString = self::addPrefixDash($serializedString);
                $serializedString .= HundredsSerializer::serialize($number->getBase());
            }
        }

        if ($serializedString === '') {
            $serializedString = "zéro";
        }

        return $serializedString;
    }

    private static function shouldPass(Hundreds $hundreds): bool
    {
        return $hundreds->getBase() === "0" &&
            $hundreds->getDecimal() === "0" &&
            $hundreds->getHundred() === "0";
    }
}
