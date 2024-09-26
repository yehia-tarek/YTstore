<?php

namespace App\Http\Controllers\Backend;

use App\Models\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Services\Setting\ISettingService;

class SettingController extends Controller
{

    protected $settingService;

    public function __construct(ISettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function settings()
    {
        $data = $this->settingService->getSettings();

        return view('backend.setting', [
            'data' => $data
        ]);
    }

    public function settingsUpdate(SettingRequest $request)
    {
        $status = $this->settingService->updateSettings($request->validated());

        if ($status) {
            request()->session()->flash('success', 'Setting successfully updated');
        } else {
            request()->session()->flash('error', 'No Updated Has Been Made');
        }

        return redirect()->route('admin');
    }
}
