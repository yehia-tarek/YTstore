<?php

namespace App\Repositories\Brand;

interface IBrandRepository
{
    public function getAllBrands($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC');
    public function getBrandById($id);
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
}
