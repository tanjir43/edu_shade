<?php

namespace App\Services;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Cache;

class SystemSettingService
{
    protected $cacheKey = 'system_settings';

    public function get($key, $default = null)
    {
        $settings = Cache::rememberForever($this->cacheKey, function () {
            return SystemSetting::all()->pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    public function set(array $settings)
    {
        foreach ($settings as $key => $value) {
            $setting = SystemSetting::withTrashed()->where('key', $key)->first();

            if ($setting) {
                if ($setting->trashed()) {
                    $setting->restore();
                }
                $setting->update(['value' => $value]);
            } else {
                SystemSetting::create(['key' => $key, 'value' => $value]);
            }
        }

        Cache::forget($this->cacheKey);
        $this->cacheSettings();
    }

    public function all()
    {
        return Cache::rememberForever($this->cacheKey, function () {
            return SystemSetting::all()->pluck('value', 'key')->toArray();
        });
    }

    public function delete(string $key)
    {
        SystemSetting::where('key', $key)->delete();
        Cache::forget($this->cacheKey);
        $this->cacheSettings();
    }

    protected function cacheSettings()
    {
        Cache::forever($this->cacheKey, SystemSetting::all()->pluck('value', 'key')->toArray());
    }
}
