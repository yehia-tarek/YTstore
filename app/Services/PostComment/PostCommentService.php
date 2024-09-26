<?php

namespace App\Services\PostComment;

use App\Repositories\PostComment\PostCommentRepository;


class PostCommentService implements IPostCommentService
{
    private $postCommentRepository;

    public function __construct(PostCommentRepository $postCommentRepository)
    {
        $this->postCommentRepository = $postCommentRepository;
    }

    public function getPostCommentById($id)
    {
        return $this->postCommentRepository->getPostCommentById($id);
    }

    public function getAllPostCommentByUser($userId, $paginate = false, $perPage = 10)
    {
        return $this->postCommentRepository->getAllPostCommentByUser($userId, $paginate, $perPage);
    }

    public function update($id, $data)
    {
        return $this->postCommentRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->postCommentRepository->delete($id);
    }
}
