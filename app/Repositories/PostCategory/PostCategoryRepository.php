<?php

namespace App\Repositories\PostCategory;

use Illuminate\Support\Facades\DB;
use App\Repositories\PostCategory\IPostCategoryRepository;


class PostCategoryRepository implements IPostCategoryRepository
{
    public function getAllPostCategories($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc')
    {
        $query = DB::table('post_categories')
            ->orderBy($orderBy, $order);

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }
}
