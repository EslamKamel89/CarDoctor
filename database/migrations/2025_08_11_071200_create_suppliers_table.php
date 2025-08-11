<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('contact_person_name_ar')->nullable();
            $table->string('contact_person_name_en')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('tax_id')->nullable(); // VAT or commercial registration
            $table->text('address_ar')->nullable();
            $table->text('address_en')->nullable();
            $table->string('payment_terms')->nullable(); // e.g., "Net 30"
            $table->decimal('credit_limit', 15, 2)->nullable();
            $table->text('notes')->nullable();

            $table->softDeletes();
            $table->timestamps();

            // Indexes for search and filtering
            $table->index('name_ar');
            $table->index('name_en');
            $table->index('mobile');
            $table->index('email');
            $table->index(['name_ar', 'name_en']); // Composite for full-text style search
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('suppliers');
    }
};
