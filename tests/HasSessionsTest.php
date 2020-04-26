<?php

namespace Ryancco\Sessions\Tests;

use Ryancco\Sessions\Session;

class HasSessionsTest extends TestCase
{
    /** @test */
    public function it_has_sessions(): void
    {
        $this->assertInstanceOf(Session::class, $this->getUser()->sessions->first());
    }
}