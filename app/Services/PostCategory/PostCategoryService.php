<?php

namespace App\Services\PostCategory;

use App\Services\PostCategory\IPostCategoryService;
use App\Repositories\PostCategory\IPostCategoryRepository;



class PostCategoryService implements IPostCategoryService
{
    protected $postCategoryRepository;

    public function __construct(IPostCategoryRepository $postCategoryRepository)
    {
        $this->postCategoryRepository = $postCategoryRepository;
    }

    public function getAllPostCategories($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc')
    {
        return $this->postCategoryRepository->getAllPostCategories($paginate, $perPage, $orderBy, $order);
    }
}
