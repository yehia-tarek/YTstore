<?php

namespace App\Repositories\PostTag;

use Illuminate\Support\Facades\DB;
use App\Repositories\PostTag\IPostTagRepository;


class PostTagRepository implements IPostTagRepository
{
    public function getAllPostTag($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc')
    {
        $query = DB::table('post_tags')
            ->orderBy($orderBy, $order);

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function getPostTagById($id)
    {
        return DB::table('post_tags')
            ->where('id', $id)
            ->first();
    }

    public function store($data)
    {
        return DB::table('post_tags')
            ->insert($data);
    }

    public function update($data, $id)
    {
        return DB::table('post_tags')
            ->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return DB::table('post_tags')
            ->where('id', $id)
            ->delete();
    }
}
