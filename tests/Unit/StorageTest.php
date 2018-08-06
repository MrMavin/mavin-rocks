<?php

namespace Tests\Unit;

use Tests\TestCase;

class StorageTest extends TestCase
{
    public function testExample()
    {
	    $path = public_path('storage');
	    $this->assertDirectoryExists($path);
    }
}
