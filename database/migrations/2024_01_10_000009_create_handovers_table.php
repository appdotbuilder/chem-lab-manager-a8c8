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
        Schema::create('handovers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_request_id')->constrained()->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade');
            $table->foreignId('laboran_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['checkout', 'checkin']);
            $table->enum('condition', ['good', 'damaged', 'incomplete', 'missing'])->nullable();
            $table->text('condition_notes')->nullable();
            $table->json('condition_photos')->nullable()->comment('Array of photo paths');
            $table->text('laboran_notes')->nullable();
            $table->datetime('handover_date');
            $table->timestamps();
            
            $table->index(['loan_request_id', 'equipment_id', 'type']);
            $table->index('laboran_id');
            $table->index(['type', 'handover_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handovers');
    }
};