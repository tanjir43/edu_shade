<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicYear extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'year',
        'title',
        'starting_date',
        'ending_date',
        'copied_from_academic_year',
        'active_status',
        'school_id',
        'branch_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'starting_date' => 'date',
        'ending_date' => 'date',
    ];

    /**
     * Get the school that owns the academic year
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the branch that owns the academic year (if applicable)
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get all class sections for this academic year
     */
    public function classSections()
    {
        return $this->hasMany(SclClassSection::class);
    }

    /**
     * Get all students for this academic year
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get all class subjects for this academic year
     */
    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class);
    }

    /**
     * Get all teacher sections for this academic year
     */
    public function teacherSections()
    {
        return $this->hasMany(TeacherSection::class);
    }
}
