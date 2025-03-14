<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SclClassFilter
{
    protected $filters = [
        'name',
        'active_status',
        'school_id',
        'branch_id',
        'version_id',
        'shift_id'
    ];

    public function apply(Builder $query, array $filters): Builder
    {
        foreach ($filters as $filter => $value) {
            if (in_array($filter, $this->filters) && !empty($value)) {
                $method = str_replace('_', '', lcfirst(ucwords($filter, '_')));
                if (method_exists($this, $method)) {
                    $this->$method($query, $value);
                }
            }
        }
        return $query;
    }

    protected function name(Builder $query, $value): void
    {
        if ($value) {
            $query->where('name', 'like', "%{$value}%");
        }
    }

    protected function activeStatus(Builder $query, $value): void
    {
        if ($value !== '' && $value !== null) {
            $query->where('active_status', $value);
        }
    }

    protected function schoolId(Builder $query, $value): void
    {
        if ($value) {
            $query->where('school_id', $value);
        }
    }

    protected function branchId(Builder $query, $value): void
    {
        if ($value) {
            $query->where('branch_id', $value);
        }
    }

    protected function versionId(Builder $query, $value): void
    {
        if ($value) {
            $query->where('version_id', $value);
        }
    }

    protected function shiftId(Builder $query, $value): void
    {
        if ($value) {
            $query->where('shift_id', $value);
        }
    }
}
