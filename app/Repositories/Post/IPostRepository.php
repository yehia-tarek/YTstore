<?php

namespace App\Repositories\Post;

interface IPostRepository
{
    public function getAllPost($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc');
}
