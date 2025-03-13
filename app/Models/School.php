<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function branches() : HasMany
    {
        return $this->hasMany(Branch::class);
    }

    public function academicYears() : HasMany
    {
        return $this->hasMany(AcademicYear::class);
    }

    public function versions() : HasMany
    {
        return $this->hasMany(Version::class);
    }

    public function shifts() : HasMany
    {
        return $this->hasMany(Shift::class);
    }

    public function classes() : HasMany
    {
        return $this->hasMany(SclClass::class, 'school_id');
    }

    public function sections() : HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function teachers() : HasMany
    {
        return $this->hasMany(Teacher::class);
    }

    public function students() : HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function subjects() : HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function classSections() : HasMany
    {
        return $this->hasMany(SclClassSection::class, 'school_id');
    }

    public function classSubjects() : HasMany
    {
        return $this->hasMany(ClassSubject::class);
    }

    public function teacherSections() : HasMany
    {
        return $this->hasMany(TeacherSection::class);
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

    public function schoolSessions() : HasMany
    {
        return $this->hasMany(SchoolSession::class);
    }
}
