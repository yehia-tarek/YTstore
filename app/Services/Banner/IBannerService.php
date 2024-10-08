<?php

namespace App\Services\Banner;

interface IBannerService
{
    public function getAllBanners($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC');
    public function getBannerById($id);
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
}

