<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('code')->nullable()->unique()->index();
            $table->string('name_ar')->nullable()->unique()->index();
            $table->string('name_en')->nullable()->unique()->index();
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->decimal('buy_price', 15, 2)->nullable();
            $table->decimal('sell_price', 15, 2)->nullable();
            $table->integer('min_stock_quantity')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('products');
    }
};
