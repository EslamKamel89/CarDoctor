<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\ParallelTesting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase {
    use RefreshDatabase;
    protected function setUp(): void {
        parent::setUp();

        // Deterministic time for FIFO/created_at ordering
        Carbon::setTestNow('2025-08-20 10:00:00');

        // Optional: speed up foreign key checks in bulk inserts
        // Schema::disableForeignKeyConstraints();
        // Schema::enableForeignKeyConstraints();
    }

    protected function advanceMinutes(int $mins): void {
        Carbon::setTestNow(Carbon::now()->addMinutes($mins));
    }
}
