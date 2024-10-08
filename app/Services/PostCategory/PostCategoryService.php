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

    public function getPostCategoryById($id)
    {
        return $this->postCategoryRepository->getPostCategoryById($id);
    }

    public function store($data)
    {
        $data['slug'] = generateSlug($data['title'], 'post_categories');

        return $this->postCategoryRepository->store($data);
    }

    public function update($data, $id)
    {
        $post = $this->postCategoryRepository->getPostCategoryById($id);

        if ($data['title'] != $post->title) {
            $data['slug'] = generateSlug($data['title'], 'post_categories');
        }
        
        return $this->postCategoryRepository->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->postCategoryRepository->destroy($id);
    }
}
