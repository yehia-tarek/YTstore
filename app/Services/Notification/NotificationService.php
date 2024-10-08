<?php

namespace App\Services\Notification;

use App\Repositories\Notification\INotificationRepository;

class NotificationService implements INotificationService
{
    protected $notificationRepository;

    public function __construct(INotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function all($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc')
    {
        return $this->notificationRepository->all($paginate, $perPage, $orderBy, $order);
    }

    public function getNotificationById($id)
    {
        return $this->notificationRepository->getNotificationById($id);
    }

    public function show($id)
    {
        $notification = $this->notificationRepository->getNotificationById($id);
        if ($notification) {
            $this->notificationRepository->markAsRead($id);
            $notificationUrl = json_decode($notification->data)->actionURL;

            return redirect($notificationUrl);
        }
    }

    public function delete($id)
    {
        return $this->notificationRepository->delete($id);
    }
}
