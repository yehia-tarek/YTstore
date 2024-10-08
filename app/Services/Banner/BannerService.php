<?php

namespace App\Services\Banner;

use App\Repositories\Banner\IBannerRepository;

class BannerService implements IBannerService
{
    protected $bannerRepository;

    public function __construct(IBannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function getAllBanners($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC')
    {
        return $this->bannerRepository->getAllBanners($paginate, $perPage, $orderBy, $order);
    }

    public function getBannerById($id)
    {
        return $this->bannerRepository->getBannerById($id);
    }

    public function store($data)
    {
        $data['slug'] = generateSlug($data['title'], 'banners');

        return $this->bannerRepository->store($data);
    }

    public function update($data, $id)
    {
        $banner = $this->getBannerById($id);

        if($data['title'] != $banner->title){

            $data['slug'] = generateSlug($data['title'], 'banners');
        }

        return $this->bannerRepository->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->bannerRepository->destroy($id);
    }
}
