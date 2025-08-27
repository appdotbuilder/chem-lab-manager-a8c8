<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Handover
 *
 * @property int $id
 * @property int $loan_request_id
 * @property int $equipment_id
 * @property int $laboran_id
 * @property string $type
 * @property string|null $condition
 * @property string|null $condition_notes
 * @property array|null $condition_photos
 * @property string|null $laboran_notes
 * @property \Illuminate\Support\Carbon $handover_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\LoanRequest $loanRequest
 * @property-read \App\Models\Equipment $equipment
 * @property-read \App\Models\User $laboran
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Handover newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Handover newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Handover query()
 * @method static \Illuminate\Database\Eloquent\Builder|Handover whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Handover whereConditionNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Handover whereConditionPhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Handover whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Handover whereEquipmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Handover whereHandoverDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Handover whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Handover whereLaboranId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Handover whereLaboranNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Handover whereLoanRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Handover whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Handover whereUpdatedAt($value)
 * @method static \Database\Factories\HandoverFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Handover extends Model
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
        'laboran_id',
        'type',
        'condition',
        'condition_notes',
        'condition_photos',
        'laboran_notes',
        'handover_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'condition_photos' => 'array',
        'handover_date' => 'datetime',
    ];

    /**
     * Get the loan request that owns the handover.
     */
    public function loanRequest(): BelongsTo
    {
        return $this->belongsTo(LoanRequest::class);
    }

    /**
     * Get the equipment for the handover.
     */
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get the laboran who handled the handover.
     */
    public function laboran(): BelongsTo
    {
        return $this->belongsTo(User::class, 'laboran_id');
    }
}