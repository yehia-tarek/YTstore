<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $messages = Message::paginate(20);

        return view('backend.message.index', [
            'messages' => $messages
        ]);
    }

    public function messageFive()
    {
        $message = Message::whereNull('read_at')->limit(5)->get();
        return response()->json($message);
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
        $message = Message::create($request->all());

        $data = [
            'url' => route('message.show', $message->id),
            'date' => $message->created_at->format('F d, Y h:i A'),
            'name' => $message->name,
            'email' => $message->email,
            'phone' => $message->phone,
            'message' => $message->message,
            'subject' => $message->subject,
            'photo' => auth()->user()->photo
        ];

        event(new MessageSent($data));
        exit();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(Request $request, $id)
    {
        $message = Message::find($id);

        if (!$message) {
            return back();
        }

        $message->read_at = Carbon::now();
        $message->save();

        return view('backend.message.show',[
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
        $message = Message::find($id);

        $status = $message->delete();

        if ($status) {
            request()->session()->flash('success', 'Successfully deleted message');
        } else {
            request()->session()->flash('error', 'Error occurred please try again');
        }
        return back();
    }
}
