<?php

namespace App\Services\Setting;


interface ISettingService
{
    public function getSettings();
    public function updateSettings($request);
}
