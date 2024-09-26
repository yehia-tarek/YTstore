<?php

namespace App\Repositories\Order;


interface IOrderRepository
{
    public function getOrdersByUser($userId, $paginate = false, $perPage = 10);
    public function getOrderById($id);
    public function delete($id);
}
