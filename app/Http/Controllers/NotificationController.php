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
    
    public function allNotifications(Request $request)
    {
        $user = $this->user->find(\Request::session()->get('user_id'));
        $notifications = $user->notifications()->paginate(15);
    	$user->unreadNotifications->markAsRead();
        return view('notifications', compact('user', 'notifications'));
    }

    public function newNotifications(Request $request)
    {
    	$user = $this->user->find(\Request::session()->get('user_id'));
    	$notifications = $user->unreadNotifications()->pluck('data');
    	if($request->markAsRead == 'yes'){
    		$user->unreadNotifications->markAsRead();
    	}
        return json_encode($notifications);
    }
}
