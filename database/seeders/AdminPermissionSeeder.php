<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminPermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $role =   Role::create([
            'name' => 'admin',
            'name_ar' => 'أدمن',
            'guard_name' => 'web',
        ]);
        $permissions = Permission::all();
        $role->permissions()->sync($permissions);
        $user = User::where('email', 'admin@gmail.com')->first();
        $user->assignRole($role);
    }
}
