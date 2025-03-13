<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'student_code',
        'roll_number',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'photo',
        'school_id',
        'branch_id',
        'academic_year_id',
        'scl_class_id',
        'section_id',
        'version_id',
        'shift_id',
        'user_id',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Get the school that owns the student
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the branch that owns the student (if applicable)
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the academic year that owns the student
     */
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Get the class that owns the student
     */
    public function class()
    {
        return $this->belongsTo(SclClass::class, 'scl_class_id');
    }

    /**
     * Get the section that owns the student
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Get the version that owns the student (if applicable)
     */
    public function version()
    {
        return $this->belongsTo(Version::class);
    }

    /**
     * Get the shift that owns the student (if applicable)
     */
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    /**
     * Get user account associated with this student (if applicable)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get class section for this student's current class and section
     */
    public function classSection()
    {
        return $this->hasOneThrough(
            SclClassSection::class,
            SclClass::class,
            'id',
            'scl_class_id',
            'scl_class_id',
            'id'
        )->where('section_id', $this->section_id);
    }
}
