<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\LoanRequest
 *
 * @property int $id
 * @property string $request_number
 * @property int $borrower_id
 * @property int|null $supervisor_id
 * @property string $purpose
 * @property \Illuminate\Support\Carbon $requested_start_date
 * @property \Illuminate\Support\Carbon $requested_end_date
 * @property \Illuminate\Support\Carbon|null $actual_start_date
 * @property \Illuminate\Support\Carbon|null $actual_end_date
 * @property string $status
 * @property string|null $jsa_document_path
 * @property string|null $notes
 * @property string|null $rejection_reason
 * @property string|null $qr_code
 * @property \Illuminate\Support\Carbon|null $submitted_at
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property \Illuminate\Support\Carbon|null $rejected_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $borrower
 * @property-read \App\Models\User|null $supervisor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoanRequestItem> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Approval> $approvals
 * @property-read int|null $approvals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Handover> $handovers
 * @property-read int|null $handovers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Fine> $fines
 * @property-read int|null $fines_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereActualEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereActualStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereBorrowerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereJsaDocumentPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest wherePurpose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereQrCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereRejectedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereRejectionReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereRequestNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereRequestedEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereRequestedStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereSubmittedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereSupervisorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest pending()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest active()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequest overdue()
 * @method static \Database\Factories\LoanRequestFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class LoanRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'request_number',
        'borrower_id',
        'supervisor_id',
        'purpose',
        'requested_start_date',
        'requested_end_date',
        'actual_start_date',
        'actual_end_date',
        'status',
        'jsa_document_path',
        'notes',
        'rejection_reason',
        'qr_code',
        'submitted_at',
        'approved_at',
        'rejected_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'requested_start_date' => 'datetime',
        'requested_end_date' => 'datetime',
        'actual_start_date' => 'datetime',
        'actual_end_date' => 'datetime',
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    /**
     * Get the borrower that owns the loan request.
     */
    public function borrower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    /**
     * Get the supervisor that supervises the loan request.
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    /**
     * Get the items for the loan request.
     */
    public function items(): HasMany
    {
        return $this->hasMany(LoanRequestItem::class);
    }

    /**
     * Get the approvals for the loan request.
     */
    public function approvals(): HasMany
    {
        return $this->hasMany(Approval::class);
    }

    /**
     * Get the handovers for the loan request.
     */
    public function handovers(): HasMany
    {
        return $this->hasMany(Handover::class);
    }

    /**
     * Get the fines for the loan request.
     */
    public function fines(): HasMany
    {
        return $this->hasMany(Fine::class);
    }

    /**
     * Scope a query to only include pending requests.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->whereIn('status', ['submitted', 'awaiting_lecturer_approval', 'awaiting_laboran_approval']);
    }

    /**
     * Scope a query to only include active requests.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include overdue requests.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue');
    }

    /**
     * Check if the loan request is overdue.
     *
     * @return bool
     */
    public function isOverdue(): bool
    {
        return $this->status === 'active' && 
               $this->requested_end_date->isPast();
    }

    /**
     * Check if the loan request requires lecturer approval.
     *
     * @return bool
     */
    public function requiresLecturerApproval(): bool
    {
        return $this->items()->whereHas('equipment', function ($query) {
            $query->where(function ($q) {
                $q->where('requires_lecturer_approval', true)
                  ->orWhere('risk_level', 'high');
            });
        })->exists();
    }
}