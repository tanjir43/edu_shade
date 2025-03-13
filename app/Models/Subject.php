<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'subject_code',
        'description',
        'theory_marks',
        'practical_marks',
        'passing_percentage',
        'school_id',
        'branch_id',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function school() : BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    # Get all classes for this subject through class_subjects pivot

    public function classes() : BelongsToMany
    {
        return $this->belongsToMany(SclClass::class, 'class_subjects', 'subject_id', 'scl_class_id')
            ->withPivot('academic_year_id', 'school_id', 'branch_id', 'version_id', 'teacher_id', 'active_status')
            ->withTimestamps();
    }

    public function classSubjects() : HasMany
    {
        return $this->hasMany(ClassSubject::class, 'subject_id');
    }

    public function teacherSections() : HasMany
    {
        return $this->hasMany(TeacherSection::class, 'subject_id');
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
