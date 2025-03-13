<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolSession extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'session_code',
        'start_date',
        'end_date',
        'active_status',
        'school_id',
        'branch_id',
        'academic_year_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'start_date'    => 'date',
        'end_date'      => 'date',
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

    public function isCurrent()
    {
        $today = now()->format('Y-m-d');
        return $this->start_date <= $today && $this->end_date >= $today;
    }

    public function scopeCurrent($query)
    {
        $today = now()->format('Y-m-d');
        return $query->where('start_date', '<=', $today)
                     ->where('end_date', '>=', $today);
    }

    public static function getCurrentForSchool($schoolId, $branchId = null)
    {
        $query = self::where('school_id', $schoolId)
            ->where('active_status', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now());

        if ($branchId) {
            $query->where('branch_id', $branchId);
        }

        return $query->first();
    }
}
