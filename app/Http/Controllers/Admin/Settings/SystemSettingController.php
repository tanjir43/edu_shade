<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Services\SystemSettingService;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{
    public function systemSettings(SystemSettingService $settingService, Request $request) {
        // if ($can = Utils::userCan($this->user, 'settings.view')) {
        //     return $can;
        // }

        $settings  = $settingService->all();
        return redirect()->back()->with('success', 'Password updated successfully.')->with('alert_type', 'toastr');
    }

    public function systemSettingsSave(Request $request, SystemSettingService $settingService) {
        // if ($can = Utils::userCan($this->user, 'settings.save')) {
        //     return $can;
        // }

        if ($request->has('delete_key')) {
            $settingService->delete($request->delete_key);
            return redirect()->back()->with('success', 'Password updated successfully.')->with('alert_type', 'toastr');
        }

        $settings = $settingService->set($request->all());

        $envUpdates = [];

        if (!empty($envUpdates)) {
            $this->updateEnvData($envUpdates);
        }

        return redirect()->back()->with('success', 'Password updated successfully.')->with('alert_type', 'toastr');
    }

    private function updateEnvData(array $data) {
        $envFile = app()->environmentFilePath();
        $envContent = file_get_contents($envFile);

        foreach ($data as $key => $value) {
            $escapedValue = str_replace('"', '\"', $value);

            if (preg_match("/^{$key}=.*/m", $envContent)) {
                $envContent = preg_replace("/^{$key}=.*/m", "{$key}=\"{$escapedValue}\"", $envContent);
            } else {
                $envContent .= "\n{$key}=\"{$escapedValue}\"";
            }
        }

        file_put_contents($envFile, $envContent);
    }
}
