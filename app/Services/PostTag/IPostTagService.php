<?php

namespace App\Services\PostTag;

interface IPostTagService
{
    public function getAllPostTag($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc');
}
