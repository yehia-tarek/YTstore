<?php

namespace App\Repositories\Category;

interface ICategoryRepository
{
    public function getParentCategories($categoryId, $orderBy = 'id', $order = 'DESC');
    public function getAllCategoriesWithParent($paginate = true, $perPage = 10, $orderBy = 'id', $order = 'DESC', $parentCoulmns = ['parent.title as parent_title']);
    public function getChildByParentId($id);
    public function getCategoryById($id);
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
    public function shiftChildren($id);
}
