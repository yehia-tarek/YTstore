<?php

namespace App\Repositories\PostCategory;


interface IPostCategoryRepository
{
    public function getAllPostCategories($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc');
}
