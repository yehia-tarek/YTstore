<?php

namespace App\Repositories\PostComment;

use Illuminate\Support\Facades\DB;

class PostCommentRepository implements IPostCommentRepository
{

    public function getPostCommentById($id)
    {
        return DB::table('post_comments')
            ->where('post_comments.id', $id)
            ->join('posts', 'post_comments.post_id', '=', 'posts.id')
            ->select('post_comments.*', 'posts.title as post_title')
            ->first();
    }

    public function getAllPostCommentByUser($userId, $paginate = false, $perPage = 10)
    {
        $query = DB::table('post_comments')
            ->where('user_id', $userId)
            ->join('posts', 'post_comments.post_id', '=', 'posts.id')
            ->select('post_comments.*', 'posts.title as post_title');

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function update($id, $data)
    {
        return DB::table('post_comments')
            ->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return DB::table('post_comments')
            ->where('id', $id)
            ->delete();
    }
}
