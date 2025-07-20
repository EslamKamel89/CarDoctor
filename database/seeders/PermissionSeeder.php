<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $permissions = [
            'users.view' => [
                'en' => 'users.view',
                'ar' => 'عرض المستخدمين'
            ],
            'users.create' => [
                'en' => 'users.create',
                'ar' => 'إنشاء مستخدم'
            ],
            'users.delete' => [
                'en' => 'users.delete',
                'ar' => 'حذف مستخدم'
            ],
            'users.update' => [
                'en' => 'users.update',
                'ar' => 'تحديث مستخدم'
            ],
            'roles.view' => [
                'en' => 'roles.view',
                'ar' => 'عرض الأدوار'
            ],
            'roles.create' => [
                'en' => 'roles.create',
                'ar' => 'إنشاء دور'
            ],
            'roles.delete' => [
                'en' => 'roles.delete',
                'ar' => 'حذف دور'
            ],
            'roles.update' => [
                'en' => 'roles.update',
                'ar' => 'تحديث دور'
            ],
            // You can easily add more permissions in the same format:
            'settings.view' => [
                'en' => 'settings.view',
                'ar' => 'عرض الإعدادات'
            ],
            'settings.edit' => [
                'en' => 'settings.edit',
                'ar' => 'تعديل الإعدادات'
            ]
        ];
        foreach ($permissions as $key => $value) {
            Permission::create([
                'name' => $value['en'],
                'name_ar' => $value['ar'],
                'guard_name' => 'web',
            ]);
        }
    }
}
