<?php

namespace App\Services\PostCategory;


interface IPostCategoryService
{
    public function getAllPostCategories($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc');
}
