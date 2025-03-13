<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'teacher_code',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'joining_date',
        'qualification',
        'photo',
        'school_id',
        'branch_id',
        'user_id',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'joining_date' => 'date',
    ];

    /**
     * Get the school that owns the teacher
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the branch that owns the teacher (if applicable)
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get user account associated with this teacher (if applicable)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get class subjects assigned to this teacher
     */
    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class, 'teacher_id');
    }

    /**
     * Get teacher sections for this teacher
     */
    public function teacherSections()
    {
        return $this->hasMany(TeacherSection::class, 'teacher_id');
    }

    /**
     * Get all classes and sections this teacher is assigned to
     */
    public function classSections()
    {
        return $this->hasManyThrough(
            SclClassSection::class,
            TeacherSection::class,
            'teacher_id',
            'id',
            'id',
            'section_id'
        );
    }
}
