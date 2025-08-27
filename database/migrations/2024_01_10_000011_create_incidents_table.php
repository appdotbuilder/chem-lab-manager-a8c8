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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('incident_number')->unique();
            $table->foreignId('loan_request_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade');
            $table->foreignId('reported_by')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['damage', 'malfunction', 'accident', 'loss', 'other']);
            $table->enum('severity', ['minor', 'moderate', 'major', 'critical'])->default('minor');
            $table->text('description');
            $table->text('cause_analysis')->nullable();
            $table->text('immediate_action')->nullable();
            $table->text('preventive_measures')->nullable();
            $table->json('evidence_photos')->nullable()->comment('Array of photo paths');
            $table->datetime('incident_date');
            $table->enum('status', ['open', 'investigating', 'resolved', 'closed'])->default('open');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->datetime('resolved_at')->nullable();
            $table->timestamps();
            
            $table->index('incident_number');
            $table->index(['equipment_id', 'type']);
            $table->index(['reported_by', 'status']);
            $table->index('incident_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};