<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SclClassSection extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'scl_class_sections';

    protected $fillable = [
        'scl_class_id',
        'section_id',
        'school_id',
        'branch_id',
        'academic_year_id',
        'active_status',
    ];

    /**
     * Get the class that owns the class section
     */
    public function class()
    {
        return $this->belongsTo(SclClass::class, 'scl_class_id');
    }

    /**
     * Get the section that owns the class section
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Get the school that owns the class section
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the branch that owns the class section (if applicable)
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the academic year that owns the class section
     */
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Get all students in this class section for the current academic year
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'section_id', 'section_id')
            ->where('scl_class_id', $this->scl_class_id)
            ->where('academic_year_id', $this->academic_year_id);
    }

    /**
     * Get all teacher sections for this class section
     */
    public function teacherSections()
    {
        return $this->hasMany(TeacherSection::class, 'section_id', 'section_id')
            ->where('scl_class_id', $this->scl_class_id)
            ->where('academic_year_id', $this->academic_year_id);
    }
}
