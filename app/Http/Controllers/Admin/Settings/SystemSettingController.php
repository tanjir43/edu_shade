<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Services\SystemSettingService;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{
    public function generalSettings(SystemSettingService $settingService, Request $request) {
        // if ($can = Utils::userCan($this->user, 'settings.view')) {
        //     return $can;
        // }

        $settings  = $settingService->all();
        return redirect()->back()->with('success', 'Password updated successfully.')->with('alert_type', 'toastr');
    }

    public function settingsSave(Request $request, SystemSettingService $settingService) {
        // if ($can = Utils::userCan($this->user, 'settings.save')) {
        //     return $can;
        // }

        if ($request->has('delete_key')) {
            $settingService->delete($request->delete_key);
            return redirect()->back()->with('success', 'Password updated successfully.')->with('alert_type', 'toastr');
        }

        $settings = $settingService->set($request->all());

        $envUpdates = [];

        if ($request->has('is_enable_sentry')) {
            $envUpdates['SENTRY_LARAVEL_DSN'] = $request->sentry_dsn;
        }

        if ($request->has('sentry_dsn')) {
            $envUpdates['SENTRY_LARAVEL_DSN'] = $request->sentry_dsn;
        }

        if ($request->has('sentry_sample_rate')) {
            $envUpdates['SENTRY_TRACES_SAMPLE_RATE'] = $request->sentry_sample_rate;
        }

        if (!empty($envUpdates)) {
            $this->updateEnvData($envUpdates);
        }

        return redirect()->back()->with('success', 'Password updated successfully.')->with('alert_type', 'toastr');
    }
}
