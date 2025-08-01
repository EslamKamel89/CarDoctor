<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder {
    public function run(): void {
        $permissions = Permission::all();

        // 1. Owner
        $owner = Role::create([
            'name' => 'owner',
            'name_ar' => 'المالك',
            'guard_name' => 'web',
        ]);
        $owner->permissions()->sync($permissions); // Full access

        // 2. Admin
        $admin = Role::create([
            'name' => 'admin',
            'name_ar' => 'مسؤول النظام',
            'guard_name' => 'web',
        ]);
        $admin->givePermissionTo($permissions);

        // 3. Manager
        $manager = Role::create([
            'name' => 'manager',
            'name_ar' => 'المدير',
            'guard_name' => 'web',
        ]);
        $manager->permissions()->sync($permissions);

        // 4. Technician
        $technician = Role::create([
            'name' => 'technician',
            'name_ar' => 'فني',
            'guard_name' => 'web',
        ]);
        $technician->permissions()->sync($permissions->where('name', 'LIKE', "%view%"));
    }
}

  // $manager->givePermissionTo([
        //     'brands.view',
        //     'brands.create',
        //     'brands.edit',
        //     'brands.delete',
        //     'car_models.view',
        //     'car_models.create',
        //     'car_models.edit',
        //     'car_models.delete',
        //     'categories.view',
        //     'categories.create',
        //     'categories.edit',
        //     'categories.delete',
        //     'warehouses.view',
        //     'warehouses.create',
        //     'warehouses.edit',
        //     'warehouses.delete',
        //     'clients.view',
        //     'clients.create',
        //     'clients.edit',
        //     'clients.delete',
        //     'products.view',
        //     'products.create',
        //     'products.edit',
        //     'products.delete',
        //     'labours.view',
        //     'labours.create',
        //     'labours.edit',
        //     'labours.delete',
        //     'invoices.view',
        //     'invoices.create',
        //     'invoices.edit',
        //     'invoices.delete', // only own drafts
        //     'invoice.pay',
        //     'invoice.mark_as_debt',
        //     'debts.view',
        //     'credit_notes.create',
        //     'stock_logs.view',
        //     'audit_logs.view',
        // ]);

        //     $technician->givePermissionTo([
        //     'invoices.view',
        //     'clients.view',
        //     'products.view',
        //     'labours.view',
        //     'invoice.create', // limited access
        // ]);
