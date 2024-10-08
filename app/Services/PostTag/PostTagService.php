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

    public function getPostTagById($id)
    {
        return $this->postTagRepository->getPostTagById($id);
    }

    public function store($data)
    {
        $data['slug'] = generateSlug($data['title'], 'post_tags');

        return $this->postTagRepository->store($data);
    }

    public function update($data, $id)
    {
        $postTag = $this->postTagRepository->getPostTagById($id);

        if ($data['title'] != $postTag->title) {
            $data['slug'] = generateSlug($data['title'], 'post_tags');
        }

        return $this->postTagRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->postTagRepository->delete($id);
    }
}
