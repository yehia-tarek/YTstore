<?php

namespace App\Services\Post;

interface IPostService
{
    public function getAllPost($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc');
}
