<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shift extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'shift_code',
        'start_time',
        'end_time',
        'school_id',
        'branch_id',
        'version_id',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'start_time'    => 'datetime',
        'end_time'      => 'datetime',
    ];

    protected static function booted()
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('active_status', 1);
        });
    }

    public function school() : BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function version(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }

    public function classes() : HasMany
    {
        return $this->hasMany(SclClass::class, 'shift_id');
    }

    public function students()  : HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function teacherSections() : HasMany
    {
        return $this->hasMany(TeacherSection::class);
    }

    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function deletedBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}
