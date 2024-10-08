<?php

namespace App\Services\Shipping;

use App\Services\Shipping\IShippingService;
use App\Repositories\Shipping\IShippingRepository;

class ShippingService implements IShippingService
{
    protected $shippingRepository;

    public function __construct(IShippingRepository $shippingRepository)
    {
        $this->shippingRepository = $shippingRepository;
    }

    public function getAllShippings($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC')
    {
        return $this->shippingRepository->getAllShippings($paginate, $perPage, $orderBy, $order);
    }

    public function getShippingById($id)
    {
        return $this->shippingRepository->getShippingById($id);
    }

    public function store($data)
    {
        return $this->shippingRepository->store($data);
    }

    public function update($data, $id)
    {
        return $this->shippingRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->shippingRepository->delete($id);
    }
}
