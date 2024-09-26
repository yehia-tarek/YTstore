<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderRepository;


class OrderService implements IOrderService
{

    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }


    public function getOrdersByUser($userId, $paginate = false, $perPage = 10)
    {
        return $this->orderRepository->getOrdersByUser($userId, $paginate, $perPage);
    }


    public function getOrderById($id)
    {
        return $this->orderRepository->getOrderById($id);
    }


    public function delete($id)
    {
        $order = $this->getOrderById($id);

        if ($order->status == "process" || $order->status == 'delivered' || $order->status == 'cancel') {
            return 0;
        }
        
        return $this->orderRepository->delete($id);
    }
}
