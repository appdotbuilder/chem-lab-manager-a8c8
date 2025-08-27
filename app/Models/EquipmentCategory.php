<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\EquipmentCategory
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $description
 * @property string|null $icon
 * @property string $color_class
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Equipment> $equipment
 * @property-read int|null $equipment_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory whereColorClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentCategory active()
 * @method static \Database\Factories\EquipmentCategoryFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class EquipmentCategory extends Model
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
        'description',
        'icon',
        'color_class',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the equipment for the category.
     */
    public function equipment(): HasMany
    {
        return $this->hasMany(Equipment::class, 'category_id');
    }

    /**
     * Scope a query to only include active categories.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}