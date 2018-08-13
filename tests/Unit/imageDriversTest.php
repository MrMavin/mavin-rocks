<?php

namespace Tests\Unit;

use Intervention\Image\Exception\NotSupportedException;
use Tests\TestCase;

class imageDriversTest extends TestCase
{
	public function testDrivers()
	{
		$drivers = [
			'gd',
			'imagick'
		];

		$ok = 0;

		foreach ($drivers as $driver) {
			$ok += $this->tryDriver($driver);
		}

		$this->assertGreaterThan(0, $ok);
	}

	/**
	 * @param $driver
	 *
	 * @return int
	 */
	private function tryDriver($driver)
	{
		$testImage = resource_path('assets/tests/test.png');

		\Image::configure([
			'driver' => $driver
		]);

		try{
			\Image::make($testImage);

			return 1;
		}catch (NotSupportedException $e) {
			return 0;
		}
	}
}
