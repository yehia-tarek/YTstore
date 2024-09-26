<?php

namespace App\Repositories\Banner;

interface IBannerRepository
{
    public function getAllBanners($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC');
    public function getBannerById($id);
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
}
