<?php

namespace  App\Services\PostComment;


interface IPostCommentService
{
    public function getAllPostCommentByUser($userId, $paginate = false, $perPage = 10);
    public function getPostCommentById($id);
    public function update($id, $data);
    public function delete($id);
}
