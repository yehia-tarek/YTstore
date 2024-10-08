<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Notification\INotificationService;

class NotificationController extends Controller
{

    protected $notificationService;

    public function __construct(INotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        return view('backend.notification.index');
    }

    public function show(Request $request)
    {
        return $this->notificationService->show($request->id);
    }

    public function delete($id)
    {
        $status = $this->notificationService->delete($id);

        if ($status) {
            request()->session()->flash('success', 'Notification successfully deleted');
            return back();
        } else {
            request()->session()->flash('error', 'Error please try again');
            return back();
        }
    }
}
