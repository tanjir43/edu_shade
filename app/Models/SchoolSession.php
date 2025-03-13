<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'updated_by'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the school that owns the session.
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the branch that owns the session.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the academic year that owns the session.
     */
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Check if the session is active.
     */
    public function isActive()
    {
        return $this->active_status == 1;
    }

    /**
     * Scope a query to only include active sessions.
     */
    public function scopeActive($query)
    {
        return $query->where('active_status', 1);
    }

    /**
     * Check if the session is current.
     */
    public function isCurrent()
    {
        $today = now()->format('Y-m-d');
        return $this->start_date <= $today && $this->end_date >= $today;
    }

    /**
     * Scope a query to only include current sessions.
     */
    public function scopeCurrent($query)
    {
        $today = now()->format('Y-m-d');
        return $query->where('start_date', '<=', $today)
                     ->where('end_date', '>=', $today);
    }

    /**
     * Get the current session for a school.
     */
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
