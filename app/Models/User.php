<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property int|null $role_id
 * @property string $status
 * @property string|null $student_id
 * @property string|null $phone
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property int $failed_login_attempts
 * @property \Illuminate\Support\Carbon|null $locked_until
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Role|null $role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoanRequest> $loanRequests
 * @property-read int|null $loan_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoanRequest> $supervisedLoanRequests
 * @property-read int|null $supervised_loan_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Lab> $headsLabs
 * @property-read int|null $heads_labs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Lab> $assistsLabs
 * @property-read int|null $assists_labs_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFailedLoginAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLockedUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User students()
 * @method static \Illuminate\Database\Eloquent\Builder|User lecturers()
 * @method static \Illuminate\Database\Eloquent\Builder|User laborans()
 * @method static \Illuminate\Database\Eloquent\Builder|User verified()
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'status',
        'student_id',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'locked_until' => 'datetime',
        'password' => 'hashed',
        'failed_login_attempts' => 'integer',
    ];

    /**
     * Get the role that the user belongs to.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the loan requests for the user.
     */
    public function loanRequests(): HasMany
    {
        return $this->hasMany(LoanRequest::class, 'borrower_id');
    }

    /**
     * Get the loan requests supervised by the user.
     */
    public function supervisedLoanRequests(): HasMany
    {
        return $this->hasMany(LoanRequest::class, 'supervisor_id');
    }

    /**
     * Get the labs where user is head of lab.
     */
    public function headsLabs(): HasMany
    {
        return $this->hasMany(Lab::class, 'head_of_lab_id');
    }

    /**
     * Get the labs where user is laboran.
     */
    public function assistsLabs(): HasMany
    {
        return $this->hasMany(Lab::class, 'laboran_id');
    }

    /**
     * Scope a query to only include students.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStudents($query)
    {
        return $query->whereHas('role', function ($q) {
            $q->where('name', 'mahasiswa');
        });
    }

    /**
     * Scope a query to only include lecturers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLecturers($query)
    {
        return $query->whereHas('role', function ($q) {
            $q->where('name', 'dosen');
        });
    }

    /**
     * Scope a query to only include laborans.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLaborans($query)
    {
        return $query->whereHas('role', function ($q) {
            $q->where('name', 'laboran');
        });
    }

    /**
     * Scope a query to only include verified users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }

    /**
     * Check if user has specific role.
     *
     * @param  string  $roleName
     * @return bool
     */
    public function hasRole(string $roleName): bool
    {
        return $this->role && $this->role->name === $roleName;
    }

    /**
     * Check if user is admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is student.
     *
     * @return bool
     */
    public function isStudent(): bool
    {
        return $this->hasRole('mahasiswa');
    }

    /**
     * Check if user is lecturer.
     *
     * @return bool
     */
    public function isLecturer(): bool
    {
        return $this->hasRole('dosen');
    }

    /**
     * Check if user is laboran.
     *
     * @return bool
     */
    public function isLaboran(): bool
    {
        return $this->hasRole('laboran');
    }

    /**
     * Check if user is head of lab.
     *
     * @return bool
     */
    public function isHeadOfLab(): bool
    {
        return $this->hasRole('kepala_lab');
    }
}