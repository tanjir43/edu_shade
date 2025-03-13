<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'school_id',
        'name',
        'email',
        'domain',
        'address',
        'phone',
        'branch_code',
        'active_status',
        'is_enabled',
        'starting_date',
        'ending_date',
        'created_by',
        'updated_by',
        'deleted_by',
    ];


        /**
     * Get the school that owns the branch
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get all academic years of the branch
     */
    public function academicYears()
    {
        return $this->hasMany(AcademicYear::class);
    }

    /**
     * Get all versions of the branch
     */
    public function versions()
    {
        return $this->hasMany(Version::class);
    }

    /**
     * Get all shifts of the branch
     */
    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    /**
     * Get all classes of the branch
     */
    public function classes()
    {
        return $this->hasMany(SclClass::class, 'branch_id');
    }

    /**
     * Get all sections of the branch
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    /**
     * Get all teachers of the branch
     */
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    /**
     * Get all students of the branch
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get all subjects of the branch
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    /**
     * Get all class sections of the branch
     */
    public function classSections()
    {
        return $this->hasMany(SclClassSection::class, 'branch_id');
    }

    /**
     * Get all class subjects of the branch
     */
    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class);
    }

    /**
     * Get all teacher sections of the branch
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
