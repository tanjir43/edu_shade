<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherSection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'teacher_id',
        'scl_class_id',
        'section_id',
        'subject_id',
        'school_id',
        'branch_id',
        'academic_year_id',
        'version_id',
        'shift_id',
        'is_class_teacher',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Get the teacher that owns the teacher section
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the class that owns the teacher section
     */
    public function class()
    {
        return $this->belongsTo(SclClass::class, 'scl_class_id');
    }

    /**
     * Get the section that owns the teacher section
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Get the subject that owns the teacher section (if applicable)
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the school that owns the teacher section
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the branch that owns the teacher section (if applicable)
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the academic year that owns the teacher section
     */
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Get the version that owns the teacher section (if applicable)
     */
    public function version()
    {
        return $this->belongsTo(Version::class);
    }

    /**
     * Get the shift that owns the teacher section (if applicable)
     */
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    /**
     * Get the class section for this teacher section
     */
    public function classSection()
    {
        return $this->belongsTo(SclClassSection::class, 'section_id', 'section_id')
            ->where('scl_class_id', $this->scl_class_id);
    }
}
