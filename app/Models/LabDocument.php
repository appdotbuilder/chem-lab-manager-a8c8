<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\LabDocument
 *
 * @property int $id
 * @property int $lab_id
 * @property string $type
 * @property string $title
 * @property string|null $description
 * @property string $file_path
 * @property string $file_name
 * @property string $file_type
 * @property int $file_size
 * @property int $uploaded_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lab $lab
 * @property-read \App\Models\User $uploader
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument whereLabId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LabDocument whereUploadedBy($value)
 * @method static \Database\Factories\LabDocumentFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class LabDocument extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'lab_id',
        'type',
        'title',
        'description',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'uploaded_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'file_size' => 'integer',
    ];

    /**
     * Get the lab that owns the document.
     */
    public function lab(): BelongsTo
    {
        return $this->belongsTo(Lab::class);
    }

    /**
     * Get the user who uploaded the document.
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}