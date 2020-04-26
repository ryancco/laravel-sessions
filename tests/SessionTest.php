<?php

namespace Ryancco\Sessions\Tests;

use Ryancco\Sessions\Contracts\Device;
use Ryancco\Sessions\Session;
use Ryancco\Sessions\Tests\Mocks\User;

class SessionTest extends TestCase
{
    /** @test */
    public function it_belongs_to_a_user(): void
    {
        $this->assertInstanceOf(User::class, $this->getSession()->user);
    }

    /** @test */
    public function it_has_a_device(): void
    {
        $this->assertInstanceOf(Device::class, $this->getSession()->device());
    }

    /** @test */
    public function it_scopes_to_active_sessions(): void
    {
        $this->assertCount(1, Session::active(now()->subHour())->get());

        $this->getSession()->update([
            'last_activity' => now()->subHour()
        ]);

        $this->assertCount(0, Session::active(30)->get());
    }

    /** @test */
    public function it_scopes_to_inactive_sessions(): void
    {
        $this->assertCount(0, Session::inactive(now()->subHour())->get());

        $this->getSession()->update([
            'last_activity' => now()->subHour()
        ]);

        $this->assertCount(1, Session::inactive(30)->get());
    }
}
