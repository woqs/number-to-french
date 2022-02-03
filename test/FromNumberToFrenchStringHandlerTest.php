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
		];
	}
}
