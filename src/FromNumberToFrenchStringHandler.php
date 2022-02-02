<?php

declare(strict_types=1);

namespace NumberToFrench;

use NumberToFrench\Application\IntegerToNumberNormalizer;
use NumberToFrench\Application\NumberSerializer;

class FromNumberToFrenchStringHandler
{
    public function handle(array $integers): array
    {
        $numbers = [];
        foreach ($integers as $integer) {
            $numbers[] = IntegerToNumberNormalizer::normalize($integer);
        }

        $return = [];
        foreach ($numbers as $number) {
            $return[] = NumberSerializer::serialize($number);
        }

        return $return;
    }
}
