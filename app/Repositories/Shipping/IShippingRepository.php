<?php

namespace App\Repositories\Shipping;

interface IShippingRepository
{
    public function getAllShippings($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC');
    public function getShippingById($id);
    public function store($data);
    public function update($data, $id);
    public function delete($id);
}
