<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

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

    public function school() : BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function academicYear() : BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function class() : BelongsTo
    {
        return $this->belongsTo(SclClass::class, 'scl_class_id');
    }

    public function section() : BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function version() : BelongsTo
    {
        return $this->belongsTo(Version::class);
    }

    public function shift() : BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    # Get the class section for this student's current class and section

    public function classSection() : HasOneThrough
    {
        return $this->hasOneThrough(
            SclClassSection::class, SclClass::class,
            'id','scl_class_id','scl_class_id','id'
        )->where('section_id', $this->section_id);
    }

    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function deletedBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}
