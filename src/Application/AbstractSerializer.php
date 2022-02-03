<?php

namespace NumberToFrench\Application;

abstract class AbstractSerializer
{
    protected static function addPrefixDash(string $string): string
    {
        if ($string !== '') {
            $string .= '-';
        }
        return $string;
    }
}
