<?php

namespace App\Repositories\Order;

use Illuminate\Support\Facades\DB;

class OrderRepository implements IOrderRepository
{

    public function getOrdersByUser($userId, $paginate = false, $perPage = 10)
    {
        $query = DB::table('orders')->where('user_id', $userId);

        if ($paginate) {
            $query = $query->paginate($perPage);
        }

        return $query;
    }


    public function getOrderById($id)
    {
        return DB::table('orders')->where('id', $id)->first();
    }

    public function delete($id)
    {
        return DB::table('orders')->where('id', $id)->delete();
    }
}
