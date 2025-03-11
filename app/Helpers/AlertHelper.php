<?php

use App\Models\SystemSetting;

if (!function_exists('getAlertType')) {
    function getAlertType()
    {
        return cache()->remember('alert_type', 3600, function () {
            return SystemSetting::where('key', 'alert_type')->value('value') ?? 'sweetalert';
        });
    }
}
