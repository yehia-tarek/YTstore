<?php

namespace App\Repositories\Coupon;


interface ICouponRepository
{
    public function getAllCoupons($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC');
    public function getCouponById($id);
    public function getCouponByCode($code);
    public function store($data);
    public function update($data, $id);
    public function delete($id);
}
