<?php

namespace App\Repositories\Message;

use Illuminate\Support\Facades\DB;

class MessageRepository implements IMessageRepository
{
    public function getAllMessages($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc')
    {
        $query = DB::table('messages')
            ->orderBy($orderBy, $order);

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function getUnreadMessages($limit = 5, $orderBy = 'id', $order = 'desc')
    {
        return DB::table('messages')
            ->whereNull('read_at')
            ->orderBy($orderBy, $order)
            ->limit($limit)
            ->get();
    }

    public function getMessageById($id)
    {
        return DB::table('messages')->where('id', $id)->first();
    }

    public function storeAndReturnData($data)
    {
       $messageId =  DB::table('messages')->insertGetId($data);

       return DB::table('messages')->where('id', $messageId)->first();
    }

    public function delete($id)
    {
        return DB::table('messages')->where('id', $id)->delete();
    }

    public function markAsRead($id)
    {
        return DB::table('messages')->where('id', $id)->update(['read_at' => now()]);
    }
}
