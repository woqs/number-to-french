<?php

declare(strict_types=1);

namespace NumberToFrench\Domain;

class Number
{
    private const KEY_TO_VARIABLE_NAME = [
        0 => 'base',
        1 => 'thousand',
        2 => 'million',
        3 => 'billion',
    ];

    private $base;
    private $thousand;
    private $million;
    private $billion;

    public function __construct(?Hundreds $base, ?Hundreds $thousand, ?Hundreds $million, ?Hundreds $billion)
    {
        $this->base = $base;
        $this->thousand = $thousand;
        $this->million = $million;
        $this->billion = $billion;
    }

    public static function constructFromHundredsArray(array $multipleHundreds): self
    {
        $base = $thousand = $million = $billion = null;

        for ($i=0; $i < count($multipleHundreds); $i++) {
            ${self::KEY_TO_VARIABLE_NAME[$i]} = $multipleHundreds[$i];
        }

        return new self(
            $base,
            $thousand,
            $million,
            $billion
        );
    }

    public function getBase(): ?Hundreds
    {
        return $this->base;
    }

    public function getThousand(): ?Hundreds
    {
        return $this->thousand;
    }

    public function getMillion(): ?Hundreds
    {
        return $this->million;
    }

    public function getBillion(): ?Hundreds
    {
        return $this->billion;
    }
}
