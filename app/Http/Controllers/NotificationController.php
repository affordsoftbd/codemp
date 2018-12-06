<?php

namespace App\Http\Controllers;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserNotifications;

class NotificationController extends Controller
{
    protected $notification;

    public function __construct(UserNotifications $notification, User $user)
    {
        $this->middleware('check.auth');
        $this->notification = $notification;        
        $this->user = $user;
    }
    
    public function allNotifications()
    {
        $user = $this->user->find(\Request::session()->get('user_id'));
        $notifications = $user->notifications()->paginate(15);
        return view('notifications', compact('user', 'notifications'));
    }

    public function newNotifications()
    {
    	$user = $this->user->find(\Request::session()->get('user_id'));
    	$notifications = $user->unreadNotifications()->pluck('data');
        return json_encode($notifications);
    }

    public function markNotificationsAsRead()
    {
        $user = $this->user->find(\Request::session()->get('user_id'));
        $user->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
