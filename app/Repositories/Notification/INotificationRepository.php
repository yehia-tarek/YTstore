<?php

namespace App\Repositories\Notification;

interface INotificationRepository
{
    public function all($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc');
    public function getNotificationById($id);
    public function markAsRead($id);
    public function delete($id);
}
