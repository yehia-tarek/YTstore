<?php

namespace App\Services\Brand;

use App\Services\Brand\IBrandService;
use App\Repositories\Brand\IBrandRepository;

class BrandService implements IBrandService
{
    protected $brandRepository;

    public function __construct(IBrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getAllBrands($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC')
    {
        return $this->brandRepository->getAllBrands($paginate, $perPage, $orderBy, $order);
    }

    public function getBrandById($id)
    {
        return $this->brandRepository->getBrandById($id);
    }

    public function store($request)
    {
        $request['slug'] = generateSlug($request['title'], 'brands');

        return $this->brandRepository->store($request);
    }

    public function update($request, $id)
    {
        $brand = $this->brandRepository->getBrandById($id);

        if ($request['title'] != $brand->title) {
            $request['slug'] = generateSlug($request['title'], 'brands');
        }
        
        return $this->brandRepository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->brandRepository->destroy($id);
    }
}
