<?php

namespace App\Services\Brand;

interface IBrandService
{
    public function getAllBrands($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC');
    public function getBrandById($id);
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
}
