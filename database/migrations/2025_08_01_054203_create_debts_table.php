<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->decimal('original_amount', 15, 2);     // = invoice.actual_total
            $table->decimal('paid_amount', 15, 2)->default(0);
            $table->decimal('remaining_amount', 15, 2);    // = original - paid
            $table->date('due_date')->nullable();          // Optional: when to collect
            $table->text('notes')->nullable();
            $table->boolean('is_settled')->default(false); // true when remaining = 0
            $table->softDeletes();
            $table->timestamps();

            $table->index(['client_id', 'is_settled']);
            $table->index('remaining_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('debts');
    }
};
