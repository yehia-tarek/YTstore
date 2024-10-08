<?php

namespace App\Repositories\Setting;


interface ISettingRepository
{
    public function getSettings();
    public function updateSettings($data);
}
