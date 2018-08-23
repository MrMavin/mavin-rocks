<?php

namespace Tests\Unit;

use Symfony\Component\Process\Process;
use Tests\TestCase;

class TarTest extends TestCase
{
	/**
	 * Test for tar program
	 */
    public function testTar()
    {
	    $process = new Process('tar --help');
	    $process->run();

	    $this->assertEquals(0, $process->getExitCode());

    }
}
