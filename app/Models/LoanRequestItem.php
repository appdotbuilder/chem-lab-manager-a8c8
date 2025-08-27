<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\LoanRequestItem
 *
 * @property int $id
 * @property int $loan_request_id
 * @property int $equipment_id
 * @property int $quantity
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\LoanRequest $loanRequest
 * @property-read \App\Models\Equipment $equipment
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequestItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequestItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequestItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequestItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequestItem whereEquipmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequestItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequestItem whereLoanRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequestItem whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequestItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRequestItem whereUpdatedAt($value)
 * @method static \Database\Factories\LoanRequestItemFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class LoanRequestItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'loan_request_id',
        'equipment_id',
        'quantity',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
    ];

    /**
     * Get the loan request that owns the item.
     */
    public function loanRequest(): BelongsTo
    {
        return $this->belongsTo(LoanRequest::class);
    }

    /**
     * Get the equipment that belongs to the item.
     */
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }
}