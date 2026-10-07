<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function index()
    {
        $notifications = auth()->user()->notifications()->latest()->get();
        return view('frontend.notifications.index', compact('notifications'));
    }

    public function markAsRead($id){
        $notification = auth()->user()->notifications()->find($id);
        if($notification){
            $notification->markAsRead();
            return redirect()->route('orders.show', $notification->data['order_id']);
        } else {
            return redirect()->back()->with('error', 'Notification not found.');
        }
    }

    public function unreadCount()
    {
        return response()->json([
            'count' => auth()->check() ? auth()->user()->unreadNotifications()->count() : 0,
        ]);
    }
}
