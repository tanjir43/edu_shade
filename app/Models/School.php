<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'domain',
        'address',
        'phone',
        'school_code',
        'is_email_verified',
        'active_status',
        'is_enabled',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

       /**
     * Get all branches of the school
     */
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    /**
     * Get all academic years of the school
     */
    public function academicYears()
    {
        return $this->hasMany(AcademicYear::class);
    }

    /**
     * Get all versions of the school
     */
    public function versions()
    {
        return $this->hasMany(Version::class);
    }

    /**
     * Get all shifts of the school
     */
    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    /**
     * Get all classes of the school
     */
    public function classes()
    {
        return $this->hasMany(SclClass::class, 'school_id');
    }

    /**
     * Get all sections of the school
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    /**
     * Get all teachers of the school
     */
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    /**
     * Get all students of the school
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get all subjects of the school
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    /**
     * Get all class sections of the school
     */
    public function classSections()
    {
        return $this->hasMany(SclClassSection::class, 'school_id');
    }

    /**
     * Get all class subjects of the school
     */
    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class);
    }

    /**
     * Get all teacher sections of the school
     */
    public function teacherSections()
    {
        return $this->hasMany(TeacherSection::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}
