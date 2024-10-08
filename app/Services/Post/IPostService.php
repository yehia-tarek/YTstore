<?php

namespace App\Services\Post;

interface IPostService
{
    public function getAllPost($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc');
    public function getPostById($id);
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
}
