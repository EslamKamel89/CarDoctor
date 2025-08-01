<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    static array $resources = [
        'users',
        'roles',
        'brands',
        'car_models',
        'categories',
        'warehouses',
        'clients',
        'products',
        'labours',
        'invoices',
        'debts',
        'credit_notes',
        'settings',
        'audit_logs',
        'stock_logs',
    ];
    static array $actions = [
        'view' => ['ar' => 'عرض', 'en' => 'view'],
        'create' => ['ar' => 'إنشاء', 'en' => 'create'],
        'edit' => ['ar' => 'تعديل', 'en' => 'edit'],
        'delete' => ['ar' => 'حذف', 'en' => 'delete'],
    ];
    static public function getArabicLabel(string $resource): string {
        $labels = [
            'users' => 'المستخدمين',
            'roles' => 'الأدوار',
            'brands' => 'العلامات التجارية',
            'car_models' => 'موديلات السيارات',
            'categories' => 'الفئات',
            'warehouses' => 'المستودعات',
            'clients' => 'العملاء',
            'products' => 'المنتجات',
            'labours' => 'أعمال الصيانة',
            'invoices' => 'الفواتير',
            'debts' => 'المديونيات',
            'credit_notes' => 'مذكرات الإرجاع',
            'settings' => 'الإعدادات',
            'audit_logs' => 'سجلات التدقيق',
            'stock_logs' => 'سجلات المخزون',
        ];

        return $labels[$resource] ?? ucfirst($resource);
    }
    public function run(): void {
        foreach (self::$resources as $resource) {
            foreach (self::$actions as $action => $names) {
                Permission::create([
                    'name' => "{$resource}.{$action}",
                    'name_ar' => "{$names['ar']} {$this->getArabicLabel($resource)}",
                    'guard_name' => 'web',
                ]);
            }
        }
    }
}
