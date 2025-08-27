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
        Schema::create('labs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('location');
            $table->integer('capacity')->default(0);
            $table->time('opening_time')->default('08:00:00');
            $table->time('closing_time')->default('17:00:00');
            $table->text('operating_days')->nullable()->comment('JSON array of operating days');
            $table->foreignId('head_of_lab_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('laboran_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('description')->nullable();
            $table->text('rules')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('code');
            $table->index(['head_of_lab_id', 'laboran_id']);
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labs');
    }
};