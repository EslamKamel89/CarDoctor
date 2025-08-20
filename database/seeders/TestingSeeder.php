<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Warehouse;

class TestingSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        User::factory()->create([
            'name' => 'Tester',
            'email' => 'tester@example.com',
        ]);

        Warehouse::factory()->create(['name_ar' => 'المخزن الرئيسي', 'name_en' => 'Main WH']);
    }
}
