<?php

namespace App\Repositories\Product;


interface IProductRepository
{
    public function getAllProduct();
    public function getProductsCountByCategoryId($id);
    public function getProductById($id);
    public function store($data);
    public function update($data, $id);
    public function delete($id);
}
