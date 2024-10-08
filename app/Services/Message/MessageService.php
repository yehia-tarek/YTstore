<?php

namespace  App\Services\Message;

use App\Events\MessageSent;
use App\Repositories\Message\IMessageRepository;


class MessageService implements IMessageService
{

    protected $messageRepository;

    public function __construct(IMessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function getAllMessages($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'desc')
    {

        return $this->messageRepository->getAllMessages($paginate, $perPage, $orderBy, $order);
    }

    public function getUnreadMessages($limit = 5, $orderBy = 'id', $order = 'desc')
    {
        return $this->messageRepository->getAllMessages(false, $limit, $orderBy, $order);
    }

    public function getMessageById($id)
    {
        return $this->messageRepository->getMessageById($id);
    }

    public function storeAndReturnData($data)
    {
        $data['created_at'] = now();

        return $this->messageRepository->storeAndReturnData($data);
    }

    public function delete($id)
    {
        return $this->messageRepository->delete($id);
    }

    public function markAsRead($id)
    {
        return$this->messageRepository->markAsRead($id);
    }

    public function sentMessage($message)
    {
        $data = [
            'url' => route('message.show', $message->id),
            'date' => date('F d, Y h:i A', strtotime($message->created_at)),
            'name' => $message->name,
            'email' => $message->email,
            'phone' => $message->phone,
            'message' => $message->message,
            'subject' => $message->subject,
            'photo' => auth()->user()->photo
        ];

        event(new MessageSent($data));
    }
}
