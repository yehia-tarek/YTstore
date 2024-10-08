<?php

namespace App\Repositories\Setting;

use Illuminate\Support\Facades\DB;

class SettingRepository implements ISettingRepository
{

    public function getSettings()
    {
        return DB::table('settings')->first();
    }

    public function updateSettings($data)
    {
        $settingsId = DB::table('settings')->first(['id']);

        return DB::table('settings')
            ->where('id', $settingsId->id)
            ->update($data);
    }
}
