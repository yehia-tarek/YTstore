<?php

namespace App\Http\Controllers\Fronted\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Order\IOrderService;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(IOrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function index()
    {
        $orders = $this->orderService->getOrdersByUser(auth()->user()->id, true, 10);

        return view('user.order.index', [
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
        $order = $this->orderService->getOrderById($id);

        return view('user.order.show', [
            'order' => $order
        ]);
    }

    public function delete($id)
    {
        $status = $this->orderService->delete($id);
        
        if ($status) {
            request()->session()->flash('success', 'Order Successfully deleted');
        } else {
            request()->session()->flash('error', 'Order can not deleted');
        }

        return redirect()->route('user.order.index');
    }
}
