<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Version extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'school_id',
        'branch_id',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Get the school that owns the version
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the branch that owns the version (if applicable)
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get all shifts for this version
     */
    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    /**
     * Get all classes for this version
     */
    public function classes()
    {
        return $this->hasMany(SclClass::class, 'version_id');
    }

    /**
     * Get all students for this version
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get all class subjects for this version
     */
    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class);
    }

    /**
     * Get all teacher sections for this version
     */
    public function teacherSections()
    {
        return $this->hasMany(TeacherSection::class);
    }
}
