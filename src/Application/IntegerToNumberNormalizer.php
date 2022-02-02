<?php

declare(strict_types=1);

namespace NumberToFrench\Application;

use NumberToFrench\Domain\Hundreds;
use NumberToFrench\Domain\Number;

class IntegerToNumberNormalizer
{
    public static function normalize(int $providedInteger): Number
    {
        $providedInteger = (string) $providedInteger;
        $fillBlanks = strlen($providedInteger) % 3;
        if ($fillBlanks !== 0) {
            for ($i=3; $i > $fillBlanks; $i--) {
                $providedInteger = "0" . $providedInteger;
            }
        }

        $splittedInteger = str_split($providedInteger, 3);

        $normalizedHundreds = [];
        for ($i=count($splittedInteger)-1; $i >= 0; $i--) {
            $normalizedHundreds[] = new Hundreds($splittedInteger[$i][2], $splittedInteger[$i][1], $splittedInteger[$i][0]);
        }

        return Number::constructFromHundredsArray($normalizedHundreds);
    }
}
