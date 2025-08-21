<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('warehouse_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('quantity'); // signed: +in, -out
            $table->decimal('unit_cost', 15, 2);
            $table->decimal('total_cost', 15, 2); // quantity × unit_cost
            $table->enum('type', [
                'purchase',
                'sale',
                'return_from_customer',
                'return_to_supplier',
                'adjustment',
                'write_off',
                'cost_adjustment'
            ]); // purchase, sale, return_from_customer, return_to_supplier, adjustment, write_off, cost_adjustment
            $table->string('reference_type'); // e.g., App\Models\Invoice
            $table->unsignedBigInteger('reference_id');
            $table->foreignId('recorded_by_user_id')->constrained('users')->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['product_id', 'created_at']);
            $table->index(['reference_type', 'reference_id']);
            $table->index('type');
            $table->index(['product_id', 'quantity']); // for stock-on-hand
            $table->unique(['reference_type', 'reference_id', 'type'], 'stock_movements_ref_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('stock_movements');
    }
};
