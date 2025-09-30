<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Environment;
use Codeception\Test\Unit;

final class EnvironmentTest extends Unit
{
    protected function _before(): void
    {
        Environment::prepare();
    }

    public function testAppEnv(): void
    {
        $this->assertSame('test', Environment::appEnv());
    }
}
