<?php

namespace Tests\Unit;

use SensioLabs\Security\SecurityChecker;
use Tests\TestCase;

class SecurityCheckTest extends TestCase
{
    public function testSecurityCheck()
    {
        $checker = new SecurityChecker();
        $checker->check(base_path('composer.lock'));
        $errors = $checker->getLastVulnerabilityCount();

        $this->assertEquals(0, $errors);
    }
}
