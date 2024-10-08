<?php

namespace App\Services\Setting;

use App\Repositories\Setting\ISettingRepository;


class SettingService implements ISettingService
{
    protected $settingRepository;

    public function __construct(ISettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function getSettings()
    {
        return $this->settingRepository->getSettings();
    }

    public function updateSettings($request)
    {
        return $this->settingRepository->updateSettings($request);
    }
}
