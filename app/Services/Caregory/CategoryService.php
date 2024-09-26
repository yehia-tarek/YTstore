<?php

namespace App\Services\Caregory;

use App\Repositories\Product\IProductRepository;
use App\Repositories\Category\ICategoryRepository;

class CategoryService implements ICategoryService
{
    protected $categoryRepository;
    protected $productRepository;

    public function __construct(
        ICategoryRepository $categoryRepository,
        IProductRepository $productRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function getParentCategories($categoryId, $orderBy = 'id', $order = 'DESC')
    {
        return $this->categoryRepository->getParentCategories($categoryId, $orderBy, $order);
    }

    public function getAllCategoriesWithParent($paginate = true, $perPage = 10, $orderBy = 'id', $order = 'DESC', $parentCoulmns = ['parent.title as parent_title'])
    {
        return $this->categoryRepository->getAllCategoriesWithParent($paginate, $perPage, $orderBy, $order, $parentCoulmns);
    }

    public function getChildByParentId($id)
    {
        return $this->categoryRepository->getChildByParentId($id);
    }

    public function shiftChildren($id)
    {
        return $this->categoryRepository->shiftChildren($id);
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepository->getCategoryById($id);
    }

    public function store($data)
    {
        $data['slug'] = generateSlug($data['title'], 'categories');
        $data['is_parent'] = $data['is_parent'] ?? 0;

        if ($data['is_parent'] == 1) {
            $data['parent_id'] = null;
        }

        return $this->categoryRepository->store($data);
    }

    public function update($data, $id)
    {
        $category = $this->categoryRepository->getCategoryById($id);

        if ($data['title'] != $category->title) {
            $data['slug'] = generateSlug($data['title'], 'categories');
        }
        $data['is_parent'] = $data['is_parent'] ?? 0;

        if ($data['is_parent'] == 1) {
            $data['parent_id'] = null;
        }

        return $this->categoryRepository->update($data, $id);
    }

    public function destroy($id)
    {
        $productsCount = $this->productRepository->getProductsCountByCategoryId($id);

        if ($productsCount > 0) {
            return false;
        }

        return $this->categoryRepository->destroy($id);
    }
}
