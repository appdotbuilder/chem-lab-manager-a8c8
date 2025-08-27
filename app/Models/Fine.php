<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Fine
 *
 * @property int $id
 * @property int $loan_request_id
 * @property int $user_id
 * @property string $type
 * @property string $description
 * @property string $amount
 * @property string $status
 * @property \Illuminate\Support\Carbon $due_date
 * @property \Illuminate\Support\Carbon|null $paid_at
 * @property string|null $payment_notes
 * @property int|null $processed_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\LoanRequest $loanRequest
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User|null $processor
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Fine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fine query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fine whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fine whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fine whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fine whereLoanRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fine wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fine wherePaymentNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fine whereProcessedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fine whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fine whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fine whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fine pending()
 * @method static \Database\Factories\FineFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Fine extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'loan_request_id',
        'user_id',
        'type',
        'description',
        'amount',
        'status',
        'due_date',
        'paid_at',
        'payment_notes',
        'processed_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'due_date' => 'date',
        'paid_at' => 'datetime',
    ];

    /**
     * Get the loan request that owns the fine.
     */
    public function loanRequest(): BelongsTo
    {
        return $this->belongsTo(LoanRequest::class);
    }

    /**
     * Get the user who has the fine.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user who processed the fine.
     */
    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Scope a query to only include pending fines.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}