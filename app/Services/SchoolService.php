<?php

namespace App\Services;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;

class SchoolService
{
    protected $settings;

    public function __construct()
    {
        $this->settings = Cache::rememberForever('system_settings', function () {
            return SystemSetting::whereIn('key', [
                'is_mantain_branch',
                'is_mantain_version',
                'is_mantain_shift'
            ])->pluck('value', 'key')->toArray();
        });
    }

    public function manage(string $type): bool
    {
        $key = "is_mantain_{$type}";
        return isset($this->settings[$key]) ? (bool) $this->settings[$key] : false;
    }

    public function applyFilters(Builder $query): Builder
    {
        $user = Auth::user();

        $query->where('school_id', $user->school_id);

        $filterAttributes = [
            'branch'  => 'branch_id',
            'shift'   => 'shift_id',
            'version' => 'version_id',
        ];

        foreach ($filterAttributes as $settingKey => $column) {
            if ($this->manage($settingKey)) {
                $userValue = $user->$column;

                if (!is_null($userValue)) {
                    $query->where($column, $userValue);
                } else {
                    $query->whereNull($column);
                }
            }
        }

        if ($this->manage('branch')) {
            $query->whereHas('branch', function ($branchQuery) {
                $branchQuery->where('active_status', 1);
            });
        }

        if ($this->manage('shift')) {
            $query->whereHas('shift', function ($shiftQuery) {
                $shiftQuery->where('active_status', 1);
            });
        }

        if ($this->manage('version')) {
            $query->whereHas('version', function ($versionQuery) {
                $versionQuery->where('active_status', 1);
            });
        }

        return $query;
    }
}
