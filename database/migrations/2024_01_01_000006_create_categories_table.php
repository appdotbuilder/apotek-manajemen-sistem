<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Category name');
            $table->string('code')->unique()->comment('Category code');
            $table->text('description')->nullable()->comment('Category description');
            $table->enum('type', ['obat_keras', 'obat_bebas', 'alat_kesehatan', 'vitamin'])->comment('Category type');
            $table->boolean('is_active')->default(true)->comment('Category status');
            $table->timestamps();
            
            $table->index('code');
            $table->index('type');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};