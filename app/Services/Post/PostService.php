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

    public function getPostById($id)
    {
        return $this->postRepository->getPostById($id);
    }

    public function store($data)
    {
        $data['slug'] = generateSlug($data['title'], 'posts');

        $data['tags'] = isset($data['tags']) ? implode(',', $data['tags']) : '';

        return $this->postRepository->store($data);
    }

    public function update($data, $id)
    {
        $post = $this->postRepository->getPostById($id);

        if ($data['title'] != $post->title) {
            $data['slug'] = generateSlug($data['title'], 'posts');
        }

        $data['tags'] = isset($data['tags']) ? implode(',', $data['tags']) : '';

        return $this->postRepository->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->postRepository->destroy($id);
    }
}
