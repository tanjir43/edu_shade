<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SclClassFilter
{
    protected $filters = [
        'name',
        'active_status',
    ];

    public function apply(Builder $query, array $filters): Builder
    {
        foreach ($filters as $filter => $value) {
            if (method_exists($this, $filter) && !empty($value)) {
                $this->$filter($query, $value);
            }
        }
        return $query;
    }

    protected function name(Builder $query, $value): void
    {
        $query->when($value, function ($query, $value) {
            return $query->where('name', 'like', "%$value%");
        });
    }

    protected function activeStatus(Builder $query, $value): void
    {
        $query->when($value, function ($query, $value) {
            return $query->where('active_status', $value);
        });
    }
}
