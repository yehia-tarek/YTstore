<?php

namespace  App\Services\Message;

interface IMessageService
{
    public function getAllMessages($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc');
    public function getUnreadMessages($limit = 5, $orderBy = 'id', $order = 'desc');
    public function getMessageById($id);
    public function storeAndReturnData($data);
    public function delete($id);
    public function markAsRead($id);
    public function sentMessage($data);
}
