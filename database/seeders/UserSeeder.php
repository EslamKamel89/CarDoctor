<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder {

    public function run(): void {
        $owner = User::updateOrCreate([
            'email' => 'owner@cardoctor.com',
        ], [
            'name' => 'المالك',
            'password' => 'password',
        ]);
        $owner->assignRole('owner');

        $admin = User::updateOrCreate([
            'email' => 'admin@cardoctor.com',
        ], [
            'name' => 'المسؤول',
            'password' => 'password',
        ]);
        $admin->assignRole('admin');

        $manager = User::updateOrCreate([
            'email' => 'manager@cardoctor.com',
        ], [
            'name' => 'المدير',
            'password' => 'password',
        ]);
        $manager->assignRole('manager');

        $technician = User::updateOrCreate([
            'email' => 'tech@cardoctor.com',
        ], [
            'name' => 'الفني أحمد',
            'password' => 'password',
        ]);
        $technician->assignRole('technician');
    }
}
