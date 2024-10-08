<?php

namespace App\Services\Notification;

interface INotificationService
{
    public function all($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc');
    public function getNotificationById($id);
    public function show($id);
    public function delete($id);
}
