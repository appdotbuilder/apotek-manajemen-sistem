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
        Schema::create('stock_mutations', function (Blueprint $table) {
            $table->id();
            $table->string('mutation_number')->unique()->comment('Mutation reference number');
            $table->foreignId('product_stock_id')->constrained()->onDelete('restrict');
            $table->enum('type', ['in', 'out', 'adjustment', 'return_from_customer', 'return_to_distributor'])->comment('Mutation type');
            $table->integer('quantity')->comment('Quantity changed (positive or negative)');
            $table->integer('stock_before')->comment('Stock before mutation');
            $table->integer('stock_after')->comment('Stock after mutation');
            $table->text('reason')->nullable()->comment('Reason for mutation');
            $table->string('reference_type')->nullable()->comment('Reference document type');
            $table->string('reference_id')->nullable()->comment('Reference document ID');
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->timestamps();
            
            $table->index('mutation_number');
            $table->index('product_stock_id');
            $table->index('type');
            $table->index(['reference_type', 'reference_id']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_mutations');
    }
};