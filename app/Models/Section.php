<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'section_code',
        'capacity',
        'school_id',
        'branch_id',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Get the school that owns the section
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the branch that owns the section (if applicable)
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get all classes for this section through class_sections pivot
     */
    public function classes()
    {
        return $this->belongsToMany(SclClass::class, 'scl_class_sections', 'section_id', 'scl_class_id')
            ->withPivot('academic_year_id', 'school_id', 'branch_id', 'active_status')
            ->withTimestamps();
    }

    /**
     * Get all class sections for this section
     */
    public function classSections()
    {
        return $this->hasMany(SclClassSection::class, 'section_id');
    }

    /**
     * Get all students in this section
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'section_id');
    }

    /**
     * Get all teacher sections for this section
     */
    public function teacherSections()
    {
        return $this->hasMany(TeacherSection::class, 'section_id');
    }
}
