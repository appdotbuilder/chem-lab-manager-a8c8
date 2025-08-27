<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Incident
 *
 * @property int $id
 * @property string $incident_number
 * @property int|null $loan_request_id
 * @property int $equipment_id
 * @property int $reported_by
 * @property string $type
 * @property string $severity
 * @property string $description
 * @property string|null $cause_analysis
 * @property string|null $immediate_action
 * @property string|null $preventive_measures
 * @property array|null $evidence_photos
 * @property \Illuminate\Support\Carbon $incident_date
 * @property string $status
 * @property int|null $assigned_to
 * @property \Illuminate\Support\Carbon|null $resolved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\LoanRequest|null $loanRequest
 * @property-read \App\Models\Equipment $equipment
 * @property-read \App\Models\User $reporter
 * @property-read \App\Models\User|null $assignee
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Incident newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Incident newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Incident query()
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereCauseAnalysis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereEquipmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereEvidencePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereImmediateAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereIncidentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereIncidentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereLoanRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident wherePreventiveMeasures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereReportedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereResolvedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereSeverity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident open()
 * @method static \Database\Factories\IncidentFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Incident extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'incident_number',
        'loan_request_id',
        'equipment_id',
        'reported_by',
        'type',
        'severity',
        'description',
        'cause_analysis',
        'immediate_action',
        'preventive_measures',
        'evidence_photos',
        'incident_date',
        'status',
        'assigned_to',
        'resolved_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'evidence_photos' => 'array',
        'incident_date' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    /**
     * Get the loan request associated with the incident.
     */
    public function loanRequest(): BelongsTo
    {
        return $this->belongsTo(LoanRequest::class);
    }

    /**
     * Get the equipment for the incident.
     */
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get the user who reported the incident.
     */
    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    /**
     * Get the user assigned to handle the incident.
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Scope a query to only include open incidents.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpen($query)
    {
        return $query->whereIn('status', ['open', 'investigating']);
    }
}