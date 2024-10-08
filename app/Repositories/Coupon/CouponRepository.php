<?php

namespace App\Repositories\Coupon;

use Illuminate\Support\Facades\DB;
use App\Repositories\Coupon\ICouponRepository;


class CouponRepository implements ICouponRepository
{

    public function getAllCoupons($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC')
    {
        $query = DB::table('coupons')
            ->orderBy($orderBy, $order);

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function getCouponById($id)
    {
        return DB::table('coupons')
            ->where('id', $id)
            ->first();
    }

    public function getCouponByCode($code)
    {
        return DB::table('coupons')
            ->where('code', $code)
            ->first();
    }

    public function store($data)
    {
        return DB::table('coupons')->insert($data);
    }

    public function update($data, $id)
    {
        return DB::table('coupons')
            ->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return DB::table('coupons')->where('id', $id)->delete();
    }
}
