<?php

declare(strict_types=1);

namespace NumberToFrench\Domain;

class Hundreds
{
    private $base;
    private $decimal;
    private $hundred;

    public function __construct(string $base, string $decimal, string $hundred)
    {
        $this->base = $base;
        $this->decimal = $decimal;
        $this->hundred = $hundred;
    }

    public function getBase(): string
    {
        return $this->base;
    }

    public function getDecimal(): string
    {
        return $this->decimal;
    }

    public function getHundred(): string
    {
        return $this->hundred;
    }
}
