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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_stock_id')->constrained()->onDelete('restrict');
            $table->integer('quantity')->comment('Quantity sold');
            $table->decimal('unit_price', 15, 2)->comment('Unit selling price');
            $table->decimal('discount_amount', 15, 2)->default(0)->comment('Discount per item');
            $table->decimal('subtotal', 15, 2)->comment('Subtotal for this item');
            $table->decimal('cost_price', 15, 2)->comment('Cost price at time of sale');
            $table->timestamps();
            
            $table->index('sale_id');
            $table->index('product_stock_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};