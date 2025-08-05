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
        Schema::create('distributors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Distributor name');
            $table->string('code')->unique()->comment('Distributor code');
            $table->text('address')->nullable()->comment('Distributor address');
            $table->string('phone')->nullable()->comment('Distributor phone');
            $table->string('email')->nullable()->comment('Distributor email');
            $table->string('contact_person')->nullable()->comment('Contact person name');
            $table->text('notes')->nullable()->comment('Additional notes');
            $table->boolean('is_active')->default(true)->comment('Distributor status');
            $table->timestamps();
            
            $table->index('code');
            $table->index('name');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distributors');
    }
};