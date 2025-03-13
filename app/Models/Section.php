<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'section_code',
        'capacity',
        'school_id',
        'branch_id',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function school() : BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    # Get all classes for this section through class_sections pivot
    public function classes() : BelongsToMany
    {
        return $this->belongsToMany(SclClass::class, 'scl_class_sections', 'section_id', 'scl_class_id')
            ->withPivot('academic_year_id', 'school_id', 'branch_id', 'active_status')
            ->withTimestamps();
    }

    public function classSections() : HasMany
    {
        return $this->hasMany(SclClassSection::class, 'section_id');
    }

    public function students() : HasMany
    {
        return $this->hasMany(Student::class, 'section_id');
    }

    public function teacherSections() : HasMany
    {
        return $this->hasMany(TeacherSection::class, 'section_id');
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
