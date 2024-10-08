<?php

namespace App\Repositories\User;


interface IUserRepository
{
    public function getAllUsers($paginate = false , $perPage = 10, $orderBy = 'id', $order = 'desc');
}
