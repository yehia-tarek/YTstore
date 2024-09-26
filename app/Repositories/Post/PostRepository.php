<?php

namespace App\Repositories\Post;

use Illuminate\Support\Facades\DB;


class PostRepository implements IPostRepository
{
    public function getAllPost($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc')
    {
        $query = DB::table('posts')
            ->leftJoin('post_categories', 'posts.post_cat_id', '=', 'post_categories.id')
            ->leftJoin('users', 'posts.added_by', '=', 'users.id')
            ->select(
                'posts.*',
                'post_categories.title as catgory_name',
                'users.name as added_by_name'
            )
            ->orderBy($orderBy, $order);

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }
}
