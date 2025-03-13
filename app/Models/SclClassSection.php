<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SclClassSection extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'scl_class_sections';

    protected $fillable = [
        'scl_class_id',
        'section_id',
        'school_id',
        'branch_id',
        'academic_year_id',
        'active_status',
    ];

    public function class()
    {
        return $this->belongsTo(SclClass::class, 'scl_class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'section_id', 'section_id')
            ->where('scl_class_id', $this->scl_class_id)
            ->where('academic_year_id', $this->academic_year_id);
    }

    public function teacherSections()
    {
        return $this->hasMany(TeacherSection::class, 'section_id', 'section_id')
            ->where('scl_class_id', $this->scl_class_id)
            ->where('academic_year_id', $this->academic_year_id);
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

    public function isActive()
    {
        return $this->active_status == 1;
    }

    public function scopeActive($query)
    {
        return $query->where('active_status', 1);
    }
}
