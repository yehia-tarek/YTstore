<?php

namespace App\Repositories\Profile;


interface IProfileRepository
{
    public function update($data, $userId);
}
