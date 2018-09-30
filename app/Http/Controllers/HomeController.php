<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if(Auth::check()){
            return redirect('home');
        }
        return view('auth.login');
    }

    public function home()
    {
        try {
            if(!Auth::check()){
                return redirect('login');
            }
            $user = Auth::user();
            $leader_id= $user->parent_id;
            $post_creators = [$user->id,$leader_id];
            $lastPost = Post::whereIn('posts.user_id',$post_creators)->orderBy('post_id','desc')->first();
            if(!empty($lastPost)){
                $data['last_id'] = $lastPost->post_id;
            }
            else{
                $data['last_id'] = 0;
            }
            return view('home',$data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function profile()
    {
        try {
            if(!Auth::check()){
                return redirect('login');
            }
            return view('profile.index');
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
