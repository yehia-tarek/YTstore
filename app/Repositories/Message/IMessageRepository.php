<?php

namespace  App\Repositories\Message;

interface IMessageRepository
{
    public function getAllMessages($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc');
    public function getUnreadMessages($limit = 5, $orderBy = 'id', $order = 'desc');
    public function getMessageById($id);
    public function storeAndReturnData($data);
    public function delete($id);
    public function markAsRead($id);
}
