<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'teacher_code',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'joining_date',
        'qualification',
        'photo',
        'school_id',
        'branch_id',
        'user_id',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'joining_date' => 'date',
    ];

    public function school() : BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function classSubjects() : HasMany
    {
        return $this->hasMany(ClassSubject::class, 'teacher_id');
    }

    public function teacherSections() : HasMany
    {
        return $this->hasMany(TeacherSection::class, 'teacher_id');
    }

    # Get all classes and sections this teacher is assigned to
    public function classSections() : HasManyThrough
    {
        return $this->hasManyThrough(
            SclClassSection::class,TeacherSection::class,
            'teacher_id', 'id', 'id', 'section_id'
        );
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
