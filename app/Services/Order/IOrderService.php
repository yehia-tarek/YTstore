<?php

namespace  App\Services\Order;


interface IOrderService
{
    public function getOrdersByUser($userId, $paginate = false, $perPage = 10);
    public function getOrderById($id);
    public function delete($id);
}
