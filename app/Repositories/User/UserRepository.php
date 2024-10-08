<?php

namespace App\Repositories\User;

use Illuminate\Support\Facades\DB;


class UserRepository implements IUserRepository
{
    public function getAllUsers($paginate = false , $perPage = 10, $orderBy = 'id', $order = 'desc')
    {
       $query = DB::table('users')
            ->orderBy($orderBy, $order);

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }
}
