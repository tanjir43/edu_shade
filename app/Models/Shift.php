<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'shift_code',
        'start_time',
        'end_time',
        'school_id',
        'branch_id',
        'version_id',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Get the school that owns the shift
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the branch that owns the shift (if applicable)
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the version that owns the shift (if applicable)
     */
    public function version()
    {
        return $this->belongsTo(Version::class);
    }

    /**
     * Get all classes for this shift
     */
    public function classes()
    {
        return $this->hasMany(SclClass::class, 'shift_id');
    }

    /**
     * Get all students for this shift
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get all teacher sections for this shift
     */
    public function teacherSections()
    {
        return $this->hasMany(TeacherSection::class);
    }
}
