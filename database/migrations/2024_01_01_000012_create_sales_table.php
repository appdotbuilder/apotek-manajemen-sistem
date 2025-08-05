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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique()->comment('Invoice number');
            $table->timestamp('sale_date')->comment('Sale transaction date');
            $table->string('customer_name')->nullable()->comment('Customer name');
            $table->string('doctor_name')->nullable()->comment('Prescribing doctor name');
            $table->text('prescription_notes')->nullable()->comment('Prescription notes');
            $table->decimal('subtotal', 15, 2)->comment('Subtotal before discount');
            $table->decimal('discount_amount', 15, 2)->default(0)->comment('Total discount amount');
            $table->decimal('total_amount', 15, 2)->comment('Total amount after discount');
            $table->enum('payment_method', ['cash', 'transfer', 'qris'])->comment('Payment method');
            $table->decimal('paid_amount', 15, 2)->comment('Amount paid by customer');
            $table->decimal('change_amount', 15, 2)->default(0)->comment('Change amount');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('completed')->comment('Sale status');
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->timestamps();
            
            $table->index('invoice_number');
            $table->index('sale_date');
            $table->index('customer_name');
            $table->index('status');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};