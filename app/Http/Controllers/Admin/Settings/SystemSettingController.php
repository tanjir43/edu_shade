<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Services\SystemSettingService;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function systemSettings(SystemSettingService $settingService, Request $request) {
        if ($can = user_can($this->user, 'settings.view')) {
            return $can;
        }

        $settings  = $settingService->all();
        return handleResponse('System Settings updated successfully.');
    }

    public function systemSettingsSave(Request $request, SystemSettingService $settingService) {
        if ($can = user_can($this->user, 'settings.save')) {
            return $can;
        }

        if ($request->has('delete_key')) {
            $settingService->delete($request->delete_key);
            return  handleResponse('System Settings updated successfully.');
        }

        $settings = $settingService->set($request->all());

        $envUpdates = [];

        if (!empty($envUpdates)) {
            $this->updateEnvData($envUpdates);
        }

        return handleResponse('System Settings updated successfully.');
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
