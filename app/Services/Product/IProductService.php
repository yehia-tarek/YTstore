<?php

namespace  App\Services\Product;


interface IProductService
{
    public function getAllProduct();
    public function getProductById($id);
    public function getProductBySlug($slug);
    public function getProductsByCategoryId($id);
    public function store($data);
    public function update($data, $id);
    public function delete($id);
}
