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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Product name');
            $table->string('code')->unique()->comment('Product code');
            $table->string('kfa_code')->nullable()->comment('KFA reference code');
            $table->text('description')->nullable()->comment('Product description');
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->foreignId('unit_id')->constrained()->onDelete('restrict');
            $table->decimal('base_price', 15, 2)->default(0)->comment('Base cost price');
            $table->decimal('selling_price', 15, 2)->default(0)->comment('Default selling price');
            $table->integer('min_stock')->default(0)->comment('Minimum stock level');
            $table->boolean('is_active')->default(true)->comment('Product status');
            $table->timestamps();
            
            $table->index('code');
            $table->index('kfa_code');
            $table->index('name');
            $table->index('category_id');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};