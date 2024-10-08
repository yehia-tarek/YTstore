<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Services\Message\IMessageService;

class MessageController extends Controller
{

    protected $messageService;


    public function __construct(IMessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $messages = $this->messageService->getAllMessages(true, 10, 'id', 'desc');

        return view('backend.message.index', [
            'messages' => $messages
        ]);
    }

    public function messageFive()
    {
        $messages = $this->messageService->getUnreadMessages();

        return response()->json($messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        $message = $this->messageService->storeAndReturnData($request->validated());

        if ($message) {
            $this->messageService->sentMessage($message);
        }

        exit();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(Request $request, $id)
    {
        $message = $this->messageService->getMessageById($id);

        if (!$message) {
            return back();
        }

        $this->messageService->markAsRead($id);

        return view('backend.message.show', [
            'message' => $message
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $status = $this->messageService->delete($id);

        if ($status) {
            request()->session()->flash('success', 'Successfully deleted message');
        } else {
            request()->session()->flash('error', 'Error occurred please try again');
        }
        return back();
    }
}
