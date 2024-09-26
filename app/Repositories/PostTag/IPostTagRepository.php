<?php

namespace App\Repositories\PostTag;

interface IPostTagRepository
{
    public function getAllPostTag($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc');
}
