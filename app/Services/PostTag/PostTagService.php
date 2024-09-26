<?php

namespace App\Services\PostTag;

use App\Repositories\PostTag\IPostTagRepository;


class PostTagService implements IPostTagService
{
    protected $postTagRepository;

    public function __construct(IPostTagRepository $postTagRepository)
    {
        $this->postTagRepository = $postTagRepository;
    }

    public function getAllPostTag($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc')
    {
        return $this->postTagRepository->getAllPostTag($paginate, $perPage, $orderBy, $order);
    }

}
