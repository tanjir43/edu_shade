<?php

namespace App\Services;

use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ViewData
{
    protected $cacheKey = 'active_languages';

    public function languages()
    {
        return Cache::rememberForever($this->cacheKey, function () {
            return Language::where('active_status', 1)->get();
        });
    }

    public function getUserLanguage()
    {
        return Auth::user()->language_id ?? 19;
    }

    public function getCurrentLang($userLanguage)
    {
        $languages = $this->languages();
        return $languages->where('id', $userLanguage)->first();
    }
}
