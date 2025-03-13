<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'year',
        'title',
        'starting_date',
        'ending_date',
        'copied_from_academic_year',
        'active_status',
        'school_id',
        'branch_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'starting_date' => 'date',
        'ending_date'   => 'date',
    ];

    public function school() : BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function classSections() : HasMany
    {
        return $this->hasMany(SclClassSection::class);
    }

    public function students() : HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function classSubjects() : HasMany
    {
        return $this->hasMany(ClassSubject::class);
    }

    public function teacherSections() : HasMany
    {
        return $this->hasMany(TeacherSection::class);
    }

    public function schoolSessions() : HasMany
    {
        return $this->hasMany(SchoolSession::class);
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

    public static function getCurrentForSchool($schoolId, $branchId = null)
    {
        $query = self::where('school_id', $schoolId)
            ->where('active_status', 1);

        if ($branchId) {
            $query->where('branch_id', $branchId);
        }

        return $query->latest()->first();
    }
}
