<?php

namespace App\Services\Coupon;

use App\Services\Coupon\ICouponService;
use App\Repositories\Coupon\ICouponRepository;



class CouponService implements ICouponService
{

    protected $couponRepository;

    public function __construct(ICouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }


    public function getAllCoupons($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC')
    {
        return $this->couponRepository->getAllCoupons($paginate, $perPage, $orderBy, $order);
    }


    public function getCouponById($id)
    {
        return $this->couponRepository->getCouponById($id);
    }


    public function getCouponByCode($code)
    {
        return $this->couponRepository->getCouponByCode($code);
    }

    public function store($data)
    {
        return $this->couponRepository->store($data);
    }


    public function update($data, $id)
    {
        return $this->couponRepository->update($data, $id);
    }


    public function delete($id)
    {
        return $this->couponRepository->delete($id);
    }

}
