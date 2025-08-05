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
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('distributor_id')->constrained()->onDelete('restrict');
            $table->string('batch_number')->comment('Batch/lot number');
            $table->date('expiry_date')->comment('Product expiry date');
            $table->decimal('cost_price', 15, 2)->comment('Cost price for this batch');
            $table->decimal('selling_price', 15, 2)->comment('Selling price for this batch');
            $table->integer('current_stock')->default(0)->comment('Current stock quantity');
            $table->integer('initial_stock')->default(0)->comment('Initial stock quantity');
            $table->timestamps();
            
            $table->index(['product_id', 'batch_number']);
            $table->index(['product_id', 'expiry_date']);
            $table->index('distributor_id');
            $table->index('expiry_date');
            $table->unique(['product_id', 'distributor_id', 'batch_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stocks');
    }
};