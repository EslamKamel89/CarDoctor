<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\Client;
use App\Models\ClientVehicle;
use App\Models\Debt;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Labour;
use App\Models\Product;
use App\Models\StockLog;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class FullCarDoctorSeeder extends Seeder {
    public function run(): void {
        // === 1. Clear Cache & Optimize ===
        Cache::forget('categories.tree');
        Artisan::call('optimize:clear');

        // === 2. Get Users (Created by UserSeeder) ===
        $owner = User::where('email', 'owner@cardoctor.com')->first();
        $admin = User::where('email', 'admin@cardoctor.com')->first();
        $manager = User::where('email', 'manager@cardoctor.com')->first();
        $technician = User::where('email', 'tech@cardoctor.com')->first();

        if (! $manager) {
            $this->command->error('Critical: Manager user not found. Please run UserSeeder first.');
            return;
        }

        $currentUser = $manager; // Default user for actions

        // === 3. Warehouses ===
        $mainWarehouse = Warehouse::create([
            'name_ar' => 'المستودع الرئيسي',
            'name_en' => 'Main Warehouse',
            'location_ar' => 'داخل الورشة',
            'location_en' => 'Inside workshop',
            'contact_person' => 'أحمد محمد',
            'phone' => '01001234567',
            'is_active' => true,
        ]);

        $branchWarehouse = Warehouse::create([
            'name_ar' => 'فرع المعادي',
            'name_en' => 'Maadi Branch',
            'location_ar' => 'المعادي، القاهرة',
            'location_en' => 'Maadi, Cairo',
            'is_active' => true,
        ]);

        // === 4. Brands & Models ===
        $toyota = Brand::create(['name_ar' => 'تويوتا', 'name_en' => 'Toyota']);
        $honda = Brand::create(['name_ar' => 'هوندا', 'name_en' => 'Honda']);
        $bmw = Brand::create(['name_ar' => 'بي إم دبليو', 'name_en' => 'BMW']);
        $mercedes = Brand::create(['name_ar' => 'مرسيدس', 'name_en' => 'Mercedes-Benz']);

        $corolla = CarModel::create([
            'brand_id' => $toyota->id,
            'name_ar' => 'كورولا',
            'name_en' => 'Corolla',
            'year_range' => [2015, 2020],
        ]);

        $camry = CarModel::create([
            'brand_id' => $toyota->id,
            'name_ar' => 'كامري',
            'name_en' => 'Camry',
            'year_range' => [2018, 2023],
        ]);

        $civic = CarModel::create([
            'brand_id' => $honda->id,
            'name_ar' => 'سيفك',
            'name_en' => 'Civic',
            'year_range' => [2018, 2023],
        ]);

        $accord = CarModel::create([
            'brand_id' => $honda->id,
            'name_ar' => 'أكورد',
            'name_en' => 'Accord',
            'year_range' => [2017, 2022],
        ]);

        $e90 = CarModel::create([
            'brand_id' => $bmw->id,
            'name_ar' => 'E90',
            'name_en' => 'E90',
            'year_range' => [2005, 2011],
        ]);

        $cClass = CarModel::create([
            'brand_id' => $mercedes->id,
            'name_ar' => 'كلاس C',
            'name_en' => 'C-Class',
            'year_range' => [2014, 2020],
        ]);

        // === 5. Categories (Nested Tree) ===
        $engine = Category::create(['name_ar' => 'المحرك', 'name_en' => 'Engine']);
        $brakes = Category::create(['name_ar' => 'الفرامل', 'name_en' => 'Brakes']);
        $electrical = Category::create(['name_ar' => 'الكهرباء', 'name_en' => 'Electrical']);
        $suspension = Category::create(['name_ar' => 'التعليق', 'name_en' => 'Suspension']);

        // Engine → Filters
        $filters = Category::create(['name_ar' => 'الفلاتر', 'name_en' => 'Filters', 'parent_id' => $engine->id]);
        $oilFilters = Category::create(['name_ar' => 'فلتر زيت', 'name_en' => 'Oil Filter', 'parent_id' => $filters->id]);
        $airFilters = Category::create(['name_ar' => 'فلتر هواء', 'name_en' => 'Air Filter', 'parent_id' => $filters->id]);
        $fuelFilters = Category::create(['name_ar' => 'فلتر وقود', 'name_en' => 'Fuel Filter', 'parent_id' => $filters->id]);

        // Brakes → Pads & Discs
        $pads = Category::create(['name_ar' => 'بطانات فرامل', 'name_en' => 'Brake Pads', 'parent_id' => $brakes->id]);
        $discs = Category::create(['name_ar' => 'أقراص فرامل', 'name_en' => 'Brake Discs', 'parent_id' => $brakes->id]);

        // Electrical → Batteries & Lights
        $batteries = Category::create(['name_ar' => 'البطاريات', 'name_en' => 'Batteries', 'parent_id' => $electrical->id]);
        $lights = Category::create(['name_ar' => 'المصابيح', 'name_en' => 'Lights', 'parent_id' => $electrical->id]);

        // === 6. Labours ===
        $oilChange = Labour::create(['name_ar' => 'تغيير زيت المحرك', 'name_en' => 'Engine Oil Change', 'base_fee' => 150.00]);
        $airFilterReplace = Labour::create(['name_ar' => 'تغيير فلتر الهواء', 'name_en' => 'Air Filter Replacement', 'base_fee' => 50.00]);
        $brakePadReplace = Labour::create(['name_ar' => 'تغيير بطانات الفرامل', 'name_en' => 'Brake Pads Replacement', 'base_fee' => 200.00]);
        $batteryReplace = Labour::create(['name_ar' => 'استبدال البطارية', 'name_en' => 'Battery Replacement', 'base_fee' => 100.00]);

        // === 7. Products ===
        $oilFilter = Product::create([
            'category_id' => $oilFilters->id,
            'code' => 'OIL-001',
            'name_ar' => 'فلتر زيت تويوتا أصلي',
            'name_en' => 'Toyota OEM Oil Filter',
            'buy_price' => 80.00,
            'sell_price' => 120.00,
            'min_stock_quantity' => 5,
            // 'has_barcode' => true,
        ]);

        $airFilter = Product::create([
            'category_id' => $airFilters->id,
            'code' => 'AIR-001',
            'name_ar' => 'فلتر هواء هوندا',
            'name_en' => 'Honda Air Filter',
            'buy_price' => 60.00,
            'sell_price' => 100.00,
            'min_stock_quantity' => 3,
        ]);

        $brakePads = Product::create([
            'category_id' => $pads->id,
            'code' => 'PAD-001',
            'name_ar' => 'بطانات فرامل أمامية قياسية',
            'name_en' => 'Standard Front Brake Pads',
            'buy_price' => 150.00,
            'sell_price' => 250.00,
        ]);

        $battery = Product::create([
            'category_id' => $batteries->id,
            'code' => 'BAT-001',
            'name_ar' => 'بطارية 12 فولت 60 أمبير',
            'name_en' => '12V 60Ah Battery',
            'buy_price' => 800.00,
            'sell_price' => 1100.00,
        ]);

        // === 8. Assign Stock ===
        $oilFilter->warehouses()->attach($mainWarehouse->id, ['stock_quantity' => 15]);
        $oilFilter->warehouses()->attach($branchWarehouse->id, ['stock_quantity' => 8]);
        $airFilter->warehouses()->attach($mainWarehouse->id, ['stock_quantity' => 10]);
        $brakePads->warehouses()->attach($mainWarehouse->id, ['stock_quantity' => 6]);
        $battery->warehouses()->attach($mainWarehouse->id, ['stock_quantity' => 4]);

        // === 9. Applicability ===
        $oilFilter->applicableModels()->attach($corolla->id, ['notes' => 'يناسب جميع فئات كورولا']);
        $oilFilter->applicableModels()->attach($camry->id, ['notes' => 'يناسب كامري 2018-2020']);
        $airFilter->applicableModels()->attach($civic->id);
        $brakePads->applicableModels()->attach([$corolla->id, $civic->id]);
        $battery->applicableModels()->attach([$corolla->id, $civic->id, $e90->id]);

        // === 10. Clients & Vehicles ===
        $client1 = Client::create([
            'name_ar' => 'محمد علي',
            'name_en' => 'Mohamed Ali',
            'mobile' => '01112345678',
            'email' => 'mohamed@example.com',
            'address_ar' => 'القاهرة، مصر',
            'address_en' => 'Cairo, Egypt',
        ]);

        ClientVehicle::create([
            'client_id' => $client1->id,
            'car_model_id' => $corolla->id,
            'plate_number' => 'أ ب 1234',
            // 'chassis_number' => 'TOY123456789',
            'color' => 'فضي',
            'manufacturing_year' => 2018,
        ]);

        $client2 = Client::create([
            'name_ar' => 'أحمد محمد',
            'name_en' => 'Ahmed Mohamed',
            'mobile' => '01009876543',
            'email' => 'ahmed@example.com',
        ]);

        $vehicle2 = ClientVehicle::create([
            'client_id' => $client2->id,
            'car_model_id' => $e90->id,
            'plate_number' => 'ج د 5678',
            'color' => 'أسود',
            'manufacturing_year' => 2008,
        ]);

        // === 11. Invoices & Debt Flow ===
        // Invoice 1: Paid (by Manager)
        $invoice1 = Invoice::create([
            'client_id' => $client1->id,
            'client_vehicle_id' => $client1->vehicles->first()->id,
            'user_id' => $manager->id,
            'invoice_number' => 'INV-' . now()->format('YmdHis') . '-' . rand(1000, 9999),
            'date' => now(),
            'status' => 'paid',
            'calculated_total' => 120 + 150, // Oil Filter + Oil Change
            'actual_total' => 250.00,
            'actual_paid_amount' => 250.00,
            'payment_method' => 'cash',
            'labor_info' => [
                [
                    'name_ar' => 'تغيير زيت المحرك',
                    'name_en' => 'Engine Oil Change',
                    'fee' => 150.00,
                ],
            ],
        ]);

        InvoiceItem::create([
            'invoice_id' => $invoice1->id,
            'product_id' => $oilFilter->id,
            'quantity' => 1,
            'unit_price' => 120.00,
            'total_price' => 120.00,
        ]);

        // Invoice 2: Debt (Partial Payment)
        $invoice2 = Invoice::create([
            'client_id' => $client2->id,
            'client_vehicle_id' => $vehicle2->id,
            'user_id' => $manager->id,
            'invoice_number' => 'INV-' . now()->format('YmdHis') . '-' . rand(1000, 9999),
            'date' => now(),
            'status' => 'debt',
            'calculated_total' => 250 + 1100, // Brake Pads + Battery
            'actual_total' => 1300.00,
            'actual_paid_amount' => 500.00,
            'payment_method' => 'cash',
            'labor_info' => [
                [
                    'name_ar' => 'استبدال البطارية',
                    'name_en' => 'Battery Replacement',
                    'fee' => 100.00,
                ],
            ],
        ]);

        InvoiceItem::create([
            'invoice_id' => $invoice2->id,
            'product_id' => $brakePads->id,
            'quantity' => 1,
            'unit_price' => 250.00,
            'total_price' => 250.00,
        ]);

        InvoiceItem::create([
            'invoice_id' => $invoice2->id,
            'product_id' => $battery->id,
            'quantity' => 1,
            'unit_price' => 1100.00,
            'total_price' => 1100.00,
        ]);

        // Create Debt Record
        $debt = Debt::create([
            'invoice_id' => $invoice2->id,
            'client_id' => $client2->id,
            'original_amount' => 1300.00,
            'paid_amount' => 500.00,
            'remaining_amount' => 800.00,
            'due_date' => now()->addDays(14),
            'notes' => 'عميل مميز، سيتم السداد على دفعتين',
        ]);

        // === 12. Credit Note (Return) ===
        $creditNote = \App\Models\CreditNote::create([
            'invoice_id' => $invoice1->id,
            'client_id' => $client1->id,
            'credit_note_number' => 'CR-' . now()->format('YmdHis') . '-' . rand(1000, 9999),
            'issue_date' => now(),
            'reason_ar' => 'منتج تالف',
            'reason_en' => 'Defective product',
            'total_refund_amount' => 120.00,
            'payment_refund_method' => 'cash',
        ]);

        \App\Models\CreditNoteItem::create([
            'credit_note_id' => $creditNote->id,
            'invoice_item_id' => $invoice1->items->first()->id,
            'quantity' => 1,
            'refunded_amount' => 120.00,
        ]);

        // === 13. Stock Logs ===
        StockLog::create([
            'product_id' => $oilFilter->id,
            'warehouse_id' => $mainWarehouse->id,
            'user_id' => $manager->id,
            'change_type' => 'sale',
            'quantity_change' => -1,
            'previous_stock' => 15,
            'current_stock' => 14,
            'reference_type' => 'Invoice',
            'reference_id' => $invoice1->id,
        ]);

        StockLog::create([
            'product_id' => $battery->id,
            'warehouse_id' => $mainWarehouse->id,
            'user_id' => $manager->id,
            'change_type' => 'sale',
            'quantity_change' => -1,
            'previous_stock' => 4,
            'current_stock' => 3,
            'reference_type' => 'Invoice',
            'reference_id' => $invoice2->id,
        ]);

        // Return
        StockLog::create([
            'product_id' => $oilFilter->id,
            'warehouse_id' => $mainWarehouse->id,
            'user_id' => $manager->id,
            'change_type' => 'return',
            'quantity_change' => +1,
            'previous_stock' => 14,
            'current_stock' => 15,
            'reference_type' => 'CreditNote',
            'reference_id' => $creditNote->id,
        ]);

        // === 14. Audit Logs ===
        AuditLog::create([
            'user_id' => $manager->id,
            'action' => 'invoice_created',
            'subject_type' => 'Invoice',
            'subject_id' => $invoice1->id,
            'description_ar' => 'تم إنشاء فاتورة جديدة للعميل محمد علي',
            'description_en' => 'New invoice created for client Mohamed Ali',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows)',
        ]);

        AuditLog::create([
            'user_id' => $manager->id,
            'action' => 'invoice_status_changed',
            'subject_type' => 'Invoice',
            'subject_id' => $invoice1->id,
            'description_ar' => 'تغيرت حالة الفاتورة إلى "مدفوعة"',
            'description_en' => 'Invoice status changed to "paid"',
            'old_values' => ['status' => 'unpaid'],
            'new_values' => ['status' => 'paid'],
        ]);

        AuditLog::create([
            'user_id' => $manager->id,
            'action' => 'credit_note_created',
            'subject_type' => 'CreditNote',
            'subject_id' => $creditNote->id,
            'description_ar' => 'تم إنشاء مذكرة إرجاع للفاتورة رقم ' . $invoice1->invoice_number,
            'description_en' => 'Credit note created for invoice ' . $invoice1->invoice_number,
        ]);

        $this->command->info('✅ FullCarDoctorSeeder: All data seeded successfully with real users and roles!');
    }
}
