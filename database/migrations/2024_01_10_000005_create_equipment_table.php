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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->foreignId('category_id')->constrained('equipment_categories')->onDelete('cascade');
            $table->foreignId('lab_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->json('specifications')->nullable()->comment('Technical specifications as JSON');
            $table->enum('status', ['available', 'borrowed', 'maintenance', 'damaged', 'retired'])->default('available');
            $table->enum('risk_level', ['low', 'medium', 'high'])->default('low');
            $table->boolean('requires_lecturer_approval')->default(false);
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 12, 2)->nullable();
            $table->date('last_calibration_date')->nullable();
            $table->date('next_calibration_date')->nullable();
            $table->text('usage_instructions')->nullable();
            $table->text('safety_notes')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('barcode')->nullable();
            $table->string('primary_image')->nullable();
            $table->json('images')->nullable()->comment('Array of image paths');
            $table->integer('total_borrows')->default(0);
            $table->integer('total_damages')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('code');
            $table->index(['lab_id', 'category_id']);
            $table->index(['status', 'is_active']);
            $table->index('risk_level');
            $table->index('serial_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};