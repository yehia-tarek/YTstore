<?php

namespace App\Services\User;


interface IUserService
{
    public function getAllUsers($paginate = false , $perPage = 10, $orderBy = 'id', $order = 'desc');
}

