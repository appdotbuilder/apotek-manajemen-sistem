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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action')->comment('Action performed');
            $table->string('model')->comment('Model affected');
            $table->string('model_id')->comment('Model ID affected');
            $table->json('old_values')->nullable()->comment('Old values before change');
            $table->json('new_values')->nullable()->comment('New values after change');
            $table->string('ip_address')->nullable()->comment('User IP address');
            $table->string('user_agent')->nullable()->comment('User agent string');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
            
            $table->index('action');
            $table->index('model');
            $table->index('model_id');
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};