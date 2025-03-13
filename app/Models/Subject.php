<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    /**
     * Get the school that owns the subject
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the branch that owns the subject (if applicable)
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get all classes for this subject through class_subjects pivot
     */
    public function classes()
    {
        return $this->belongsToMany(SclClass::class, 'class_subjects', 'subject_id', 'scl_class_id')
            ->withPivot('academic_year_id', 'school_id', 'branch_id', 'version_id', 'teacher_id', 'active_status')
            ->withTimestamps();
    }

    /**
     * Get all class subjects for this subject
     */
    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class, 'subject_id');
    }

    /**
     * Get all teacher sections for this subject
     */
    public function teacherSections()
    {
        return $this->hasMany(TeacherSection::class, 'subject_id');
    }
}
