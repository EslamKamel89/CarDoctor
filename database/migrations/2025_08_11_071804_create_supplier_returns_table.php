<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('supplier_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('return_number')->unique(); // e.g., SR-20250810-1234
            $table->date('return_date');
            $table->text('reason_ar')->nullable();
            $table->text('reason_en')->nullable();
            $table->decimal('total_refund_amount', 15, 2)->default(0);
            $table->string('payment_refund_method')->nullable(); // cash, credit, no-refund
            $table->boolean('bulk_discount_lost')->default(false); // if return voids discount
            $table->text('notes')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->index(['purchase_id', 'return_date']);
            $table->index('return_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('supplier_returns');
    }
};
