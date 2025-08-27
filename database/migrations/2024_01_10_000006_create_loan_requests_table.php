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
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique();
            $table->foreignId('borrower_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('supervisor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('purpose');
            $table->datetime('requested_start_date');
            $table->datetime('requested_end_date');
            $table->datetime('actual_start_date')->nullable();
            $table->datetime('actual_end_date')->nullable();
            $table->enum('status', [
                'draft', 
                'submitted', 
                'awaiting_lecturer_approval', 
                'awaiting_laboran_approval', 
                'approved', 
                'rejected', 
                'active', 
                'returned', 
                'overdue',
                'cancelled'
            ])->default('draft');
            $table->string('jsa_document_path')->nullable();
            $table->text('notes')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->string('qr_code')->nullable();
            $table->datetime('submitted_at')->nullable();
            $table->datetime('approved_at')->nullable();
            $table->datetime('rejected_at')->nullable();
            $table->timestamps();
            
            $table->index('request_number');
            $table->index(['borrower_id', 'status']);
            $table->index('supervisor_id');
            $table->index(['status', 'requested_start_date']);
            $table->index(['requested_start_date', 'requested_end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_requests');
    }
};