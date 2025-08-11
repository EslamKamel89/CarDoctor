<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->cascadeOnDelete(); // Client acts as supplier
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('purchase_number')->unique(); // e.g., PO-20250810-1234
            $table->date('purchase_date');
            $table->decimal('total_amount', 15, 2);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('final_amount', 15, 2); // after discount
            $table->string('payment_method')->nullable(); // cash, credit, transfer
            $table->string('status')->default('received'); // draft, ordered, received, partially_received
            $table->text('notes')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->index(['supplier_id', 'purchase_date']);
            $table->index('purchase_number');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('purchases');
    }
};
