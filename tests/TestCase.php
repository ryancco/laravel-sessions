<?php

namespace Ryancco\Sessions\Tests;

use Illuminate\Support\Facades\Schema;
use Ryancco\Sessions\Session;
use Ryancco\Sessions\SessionsServiceProvider;
use Ryancco\Sessions\Tests\Mocks\User;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    public function getPackageProviders($app): array
    {
        return [
            SessionsServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('sessions', [
            'model' => Session::class,
            'user_model' => User::class
        ]);

        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function setUpDatabase()
    {
        Schema::create('users', function ($table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('sessions', function ($table) {
            $table->string('id')->unique();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity');
        });

        $this->getSession();
    }

    protected function getUser()
    {
        return User::firstOrCreate([
            'name' => 'John Doe',
            'email' => 'jdoe@example.com',
            'password' => 'password'
        ]);
    }

    protected function getSession()
    {
        return Session::firstOrCreate([
            'id' => '123456789',
            'user_id' => $this->getUser()->id,
            'ip_address' => '1.1.1.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36',
            'payload' => '',
            'last_activity' => now()->unix()
        ]);
    }
}
