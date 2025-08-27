<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Lab
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $location
 * @property int $capacity
 * @property string $opening_time
 * @property string $closing_time
 * @property string|null $operating_days
 * @property int|null $head_of_lab_id
 * @property int|null $laboran_id
 * @property string|null $contact_phone
 * @property string|null $contact_email
 * @property string|null $description
 * @property string|null $rules
 * @property string|null $image_path
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $headOfLab
 * @property-read \App\Models\User|null $laboran
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Equipment> $equipment
 * @property-read int|null $equipment_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LabDocument> $documents
 * @property-read int|null $documents_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Lab newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lab newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lab query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereClosingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereHeadOfLabId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereLaboran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereLaboranId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereOpeningTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereOperatingDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lab active()
 * @method static \Database\Factories\LabFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Lab extends Model
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
        'location',
        'capacity',
        'opening_time',
        'closing_time',
        'operating_days',
        'head_of_lab_id',
        'laboran_id',
        'contact_phone',
        'contact_email',
        'description',
        'rules',
        'image_path',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'operating_days' => 'array',
        'is_active' => 'boolean',
        'capacity' => 'integer',
    ];

    /**
     * Get the head of lab that owns the lab.
     */
    public function headOfLab(): BelongsTo
    {
        return $this->belongsTo(User::class, 'head_of_lab_id');
    }

    /**
     * Get the laboran that manages the lab.
     */
    public function laboran(): BelongsTo
    {
        return $this->belongsTo(User::class, 'laboran_id');
    }

    /**
     * Get the equipment for the lab.
     */
    public function equipment(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }

    /**
     * Get the documents for the lab.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(LabDocument::class);
    }

    /**
     * Scope a query to only include active labs.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}