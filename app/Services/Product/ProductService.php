<?php

namespace App\Services\Product;

use App\Services\Product\IProductService;
use App\Repositories\Product\IProductRepository;


class ProductService implements IProductService
{
    private $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProduct()
    {
        return $this->productRepository->getAllProduct();
    }

    public function getProductBySlug($slug)
    {
        return $this->productRepository->getProductBySlug($slug);
    }

    public function getProductsByCategoryId($id)
    {
        return $this->productRepository->getProductsByCategoryId($id);
    }

    public function getProductById($id)
    {
        return $this->productRepository->getProductById($id);
    }

    public function store($data)
    {
        $data['slug'] = generateSlug($data["title"], 'products');
        $data['is_featured'] = $data['is_featured'] ?? 0;

        $size = $data['size'];
        if ($size) {
            $data['size'] = implode(',', $size);
        } else {
            $data['size'] = '';
        }

        $data['discount'] = $data['discount'] ?? 0;

        return $this->productRepository->store($data);
    }

    public function update($data, $id)
    {
        $data['slug'] = generateSlug($data["title"], 'products');
        $data['is_featured'] = $data['is_featured'] ?? 0;

        $size = $data['size'];
        if ($size) {
            $data['size'] = implode(',', $size);
        } else {
            $data['size'] = '';
        }

        $data['discount'] = $data['discount'] ?? 0;

        return $this->productRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }
}
