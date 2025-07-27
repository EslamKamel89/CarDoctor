<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('description_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->timestamps();
            $table->index('parent_id');
            $table->index('name_ar');
            $table->index('name_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('categories');
    }
};
