<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassSubject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'scl_class_id',
        'subject_id',
        'school_id',
        'branch_id',
        'academic_year_id',
        'version_id',
        'teacher_id',
        'theory_marks',
        'practical_marks',
        'passing_percentage',
        'is_optional',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Get the class that owns the class subject
     */
    public function class()
    {
        return $this->belongsTo(SclClass::class, 'scl_class_id');
    }

    /**
     * Get the subject that owns the class subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the school that owns the class subject
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the branch that owns the class subject (if applicable)
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the academic year that owns the class subject
     */
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Get the version that owns the class subject (if applicable)
     */
    public function version()
    {
        return $this->belongsTo(Version::class);
    }

    /**
     * Get the teacher assigned to this class subject (if applicable)
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
