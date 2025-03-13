<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SclClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'scl_classes';

    protected $fillable = [
        'name',
        'class_code',
        'class_level',
        'school_id',
        'branch_id',
        'version_id',
        'shift_id',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function school() : BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }


    public function version() : BelongsTo
    {
        return $this->belongsTo(Version::class, 'version_id');
    }

    public function shift() : BelongsTo
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    # Get all sections for this class through scl_class_sections pivot
    public function sections() : BelongsToMany
    {
        return $this->belongsToMany(Section::class, 'scl_class_sections', 'scl_class_id', 'section_id')
            ->withPivot('academic_year_id', 'school_id', 'branch_id', 'active_status')
            ->withTimestamps();
    }

    public function classSections() : HasMany
    {
        return $this->hasMany(SclClassSection::class, 'scl_class_id');
    }


    #Get all subjects for this class through class_subjects pivot

    public function subjects() :BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'class_subjects', 'scl_class_id', 'subject_id')
            ->withPivot('academic_year_id', 'school_id', 'branch_id', 'version_id', 'teacher_id', 'active_status')
            ->withTimestamps();
    }

    public function classSubjects() : HasMany
    {
        return $this->hasMany(ClassSubject::class, 'scl_class_id');
    }

    public function students() : HasMany
    {
        return $this->hasMany(Student::class, 'scl_class_id');
    }

    public function teacherSections() : HasMany
    {
        return $this->hasMany(TeacherSection::class, 'scl_class_id');
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
