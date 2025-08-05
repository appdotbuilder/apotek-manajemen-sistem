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
        Schema::create('pharmacy_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Pharmacy name');
            $table->string('logo_path')->nullable()->comment('Path to pharmacy logo');
            $table->text('address')->comment('Pharmacy address');
            $table->string('phone')->nullable()->comment('Pharmacy phone number');
            $table->string('email')->nullable()->comment('Pharmacy email');
            $table->integer('low_stock_threshold')->default(20)->comment('Low stock alert threshold');
            $table->json('notification_recipients')->nullable()->comment('Email addresses for notifications');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_settings');
    }
};