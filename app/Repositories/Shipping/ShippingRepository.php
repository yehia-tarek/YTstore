<?php

namespace App\Repositories\Shipping;

use Illuminate\Support\Facades\DB;


class ShippingRepository implements IShippingRepository
{
    public function getAllShippings($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC')
    {
        $query = DB::table('shippings')
            ->orderBy($orderBy, $order);

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function getShippingById($id)
    {
        return DB::table('shippings')->where('id', $id)->first();
    }

    public function store($data)
    {
        return DB::table('shippings')->insert($data);
    }

    public function update($data, $id)
    {
        return DB::table('shippings')->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return DB::table('shippings')->where('id', $id)->delete();
    }
}
