<?php

namespace Tests\Unit;

use Symfony\Component\Process\Process;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class jpegOptimTest extends TestCase
{
    public function testJPEGOptim()
    {
	    $process = new Process("/usr/bin/jpegoptim -h");
	    $process->run();

	    $this->assertEquals(0, $process->getExitCode());
    }
}
