<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Plannr\Laravel\FastRefreshDatabase\Traits\FastRefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use FastRefreshDatabase;

    /**
     * Testing without vite manifest
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }
}
