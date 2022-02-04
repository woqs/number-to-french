<?php

namespace NumberToFrench\Test;

use NumberToFrench\FromNumberToFrenchStringHandler;

class FromNumberToFrenchStringHandlerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider provider
     */
    public function testNumberToFrench(int $number, string $translation)
    {
        $handler = new FromNumberToFrenchStringHandler();
        $translated = $handler->handle([$number]);
        $this->assertEquals($translation, $translated[0]);
    }

    public function provider()
    {
        return [
            [12, "douze"],
            [349, "trois-cent-quarante-neuf"],
            [71, "soixante-et-onze"],
            [91, "quatre-vingt-onze"],
            [100000000000, "cent-milliards"],
            [101000000, "cent-un-millions"],
            [81, "quatre-vingt-un"],
            [80, "quatre-vingts"],
            [100, "cent"],
            [1000, "mille"],
            [200, "deux-cents"],
            [2000, "deux-milles"],
            [201, "deux-cent-un"],
            [2001, "deux-mille-un"],
            [180000, "cent-quatre-vingt-milles"],
        ];
    }
}
