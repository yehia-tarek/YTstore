<?php

namespace App\Repositories\PostCategory;


interface IPostCategoryRepository
{
    public function getAllPostCategories($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc');
    public function getPostCategoryById($id);
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
}
