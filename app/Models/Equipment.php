<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Equipment
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $category_id
 * @property int $lab_id
 * @property string|null $description
 * @property array|null $specifications
 * @property string $status
 * @property string $risk_level
 * @property bool $requires_lecturer_approval
 * @property string|null $brand
 * @property string|null $model
 * @property string|null $serial_number
 * @property \Illuminate\Support\Carbon|null $purchase_date
 * @property string|null $purchase_price
 * @property \Illuminate\Support\Carbon|null $last_calibration_date
 * @property \Illuminate\Support\Carbon|null $next_calibration_date
 * @property string|null $usage_instructions
 * @property string|null $safety_notes
 * @property string|null $qr_code
 * @property string|null $barcode
 * @property string|null $primary_image
 * @property array|null $images
 * @property int $total_borrows
 * @property int $total_damages
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EquipmentCategory $category
 * @property-read \App\Models\Lab $lab
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoanRequestItem> $loanRequestItems
 * @property-read int|null $loan_request_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Incident> $incidents
 * @property-read int|null $incidents_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereLabId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereLastCalibrationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereNextCalibrationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment wherePrimaryImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment wherePurchasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereQrCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereRequiresLecturerApproval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereRiskLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereSafetyNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereSpecifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereTotalBorrows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereTotalDamages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereUsageInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment available()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment highRisk()
 * @method static \Database\Factories\EquipmentFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Equipment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'code',
        'category_id',
        'lab_id',
        'description',
        'specifications',
        'status',
        'risk_level',
        'requires_lecturer_approval',
        'brand',
        'model',
        'serial_number',
        'purchase_date',
        'purchase_price',
        'last_calibration_date',
        'next_calibration_date',
        'usage_instructions',
        'safety_notes',
        'qr_code',
        'barcode',
        'primary_image',
        'images',
        'total_borrows',
        'total_damages',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'specifications' => 'array',
        'images' => 'array',
        'requires_lecturer_approval' => 'boolean',
        'is_active' => 'boolean',
        'purchase_date' => 'date',
        'last_calibration_date' => 'date',
        'next_calibration_date' => 'date',
        'purchase_price' => 'decimal:2',
        'total_borrows' => 'integer',
        'total_damages' => 'integer',
    ];

    /**
     * Get the category that owns the equipment.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(EquipmentCategory::class);
    }

    /**
     * Get the lab that owns the equipment.
     */
    public function lab(): BelongsTo
    {
        return $this->belongsTo(Lab::class);
    }

    /**
     * Get the loan request items for the equipment.
     */
    public function loanRequestItems(): HasMany
    {
        return $this->hasMany(LoanRequestItem::class);
    }

    /**
     * Get the incidents for the equipment.
     */
    public function incidents(): HasMany
    {
        return $this->hasMany(Incident::class);
    }

    /**
     * Scope a query to only include available equipment.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')->where('is_active', true);
    }

    /**
     * Scope a query to only include high risk equipment.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHighRisk($query)
    {
        return $query->where('risk_level', 'high');
    }

    /**
     * Check if equipment is available for borrowing.
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->status === 'available' && $this->is_active;
    }

    /**
     * Check if equipment requires lecturer approval.
     *
     * @return bool
     */
    public function requiresLecturerApproval(): bool
    {
        return $this->requires_lecturer_approval || $this->risk_level === 'high';
    }
}