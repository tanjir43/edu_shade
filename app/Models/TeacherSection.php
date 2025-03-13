<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function teacher() : BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function class() : BelongsTo
    {
        return $this->belongsTo(SclClass::class, 'scl_class_id');
    }

    public function section() : BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function subject() : BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

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

    public function version() : BelongsTo
    {
        return $this->belongsTo(Version::class);
    }

    public function shift() : BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

    # Get the class section for this teacher section
    public function classSection() : BelongsTo
    {
        return $this->belongsTo(SclClassSection::class, 'section_id', 'section_id')
            ->where('scl_class_id', $this->scl_class_id);
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
