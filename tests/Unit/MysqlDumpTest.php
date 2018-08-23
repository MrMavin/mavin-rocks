<?php

namespace Tests\Unit;

use Symfony\Component\Process\Process;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MysqlDumpTest extends TestCase
{
	/**
	 * Test for mysqldump program
	 */
    public function testMysqlDump()
    {
        $process = new Process('mysqldump --help');
        $process->run();

	    $this->assertEquals(0, $process->getExitCode());
    }
}
