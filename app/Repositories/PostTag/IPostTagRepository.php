<?php

namespace App\Repositories\PostTag;

interface IPostTagRepository
{
    public function getAllPostTag($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc');
    public function getPostTagById($id);
    public function store($data);
    public function update($data, $id);
    public function delete($id);
}
