<?php

namespace App\Repositories\Profile;

use Illuminate\Support\Facades\DB;

class ProfileRepository implements IProfileRepository
{
    public function update($data, $userId)
    {
        return DB::table('users')->where('id', $userId)->update($data);
    }
}
