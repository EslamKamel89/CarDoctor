<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('credit_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->string('credit_note_number')->unique();
            $table->date('issue_date');
            $table->text('reason_ar');
            $table->text('reason_en');
            $table->decimal('total_refund_amount', 15, 2);
            $table->enum('payment_refund_method', ['cash', 'card', 'no-refund'])->unique();
            $table->softDeletes();
            $table->timestamps();

            $table->index('credit_note_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('credit_notes');
    }
};
