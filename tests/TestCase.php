<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations, withFaker {
        runDatabaseMigrations as baseRunDatabaseMigrations;
    }

    public function runDatabaseMigrations(): void
    {
        $this->baseRunDatabaseMigrations();
        $this->artisan('db:seed');
    }

    public function setUpTraits(): array
    {
        $this->app->detectEnvironment(fn() => 'testing');

        $configs = [
            'app.env' => 'testing',
            'hashing.bcrypt.rounds' => 4,
            'cache.default' => 'array',
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'mail.default' => 'array',
            'queue.default' => 'sync',
            'session.driver' => 'array',
            'telescope.enabled' => false,
        ];

        foreach ($configs as $key => $value) {
            config([$key => $value]);
        }

        return parent::setUpTraits();
    }

    protected function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }
}
