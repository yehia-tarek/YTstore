<?php

namespace App\Services\User;

use App\Repositories\User\IUserRepository;



class UserService implements IUserService
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getAllUsers($paginate = false , $perPage = 10, $orderBy = 'id', $order = 'desc')
    {
        return $this->userRepository->getAllUsers($paginate, $perPage, $orderBy, $order);
    }
}
