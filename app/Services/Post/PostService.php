<?php

namespace App\Services\Post;

use App\Repositories\Post\IPostRepository;


class PostService implements IPostService
{
    protected $postRepository;

    public function __construct(IPostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPost($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc')
    {
        return $this->postRepository->getAllPost($paginate, $perPage, $orderBy, $order);
    }
}
