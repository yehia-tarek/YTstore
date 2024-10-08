<?php

namespace App\Repositories\Notification;

use Illuminate\Support\Facades\DB;

class NotificationRepository implements INotificationRepository
{

    public function all($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc')
    {
        $query = DB::table('notifications')
            ->orderBy($orderBy, $order);

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function getNotificationById($id)
    {
        return DB::table('notifications')
            ->where('id', $id)
            ->first();
    }

    public function markAsRead($id)
    {
        return DB::table('notifications')
            ->where('id', $id)
            ->update(['read_at' => now()]);
    }

    public function delete($id)
    {
        return DB::table('notifications')
            ->where('id', $id)
            ->delete();
    }
}
