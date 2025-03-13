<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SclClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'scl_classes';

    protected $fillable = [
        'name',
        'class_code',
        'class_level',
        'school_id',
        'branch_id',
        'version_id',
        'shift_id',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Get the school that owns the class
     */
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    /**
     * Get the branch that owns the class (if applicable)
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /**
     * Get the version that owns the class (if applicable)
     */
    public function version()
    {
        return $this->belongsTo(Version::class, 'version_id');
    }

    /**
     * Get the shift that owns the class (if applicable)
     */
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    /**
     * Get all sections for this class through class_sections pivot
     */
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'scl_class_sections', 'scl_class_id', 'section_id')
            ->withPivot('academic_year_id', 'school_id', 'branch_id', 'active_status')
            ->withTimestamps();
    }

    /**
     * Get all class sections for this class
     */
    public function classSections()
    {
        return $this->hasMany(SclClassSection::class, 'scl_class_id');
    }

    /**
     * Get all subjects for this class
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subjects', 'scl_class_id', 'subject_id')
            ->withPivot('academic_year_id', 'school_id', 'branch_id', 'version_id', 'teacher_id', 'active_status')
            ->withTimestamps();
    }

    /**
     * Get all class subjects for this class
     */
    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class, 'scl_class_id');
    }

    /**
     * Get all students in this class
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'scl_class_id');
    }

    /**
     * Get all teacher sections for this class
     */
    public function teacherSections()
    {
        return $this->hasMany(TeacherSection::class, 'scl_class_id');
    }
}
